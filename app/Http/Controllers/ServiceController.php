<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\ServiceRepository;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private readonly ServiceRepository $repository) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) ($request->integer('per_page') ?: 15);
        return response()->json(new ServiceCollection($this->repository->paginate($perPage)));
    }

    public function store(StoreServiceRequest $request): JsonResponse
    {
        // 1. On récupère les données validées du formulaire
        $data = $request->validated();

        // 2. On vérifie si un fichier image est présent dans la requête
        if ($request->hasFile('image')) {
            // Déplace physiquement le fichier de C:\xampp\tmp vers votre dossier public (storage/app/public/services)
            $path = $request->file('image')->store('services', 'public');

            // Remplace le chemin temporaire par l'URL publique accessible par Angular
            // Exemple généré : "http://127.0.0"
            $data['image'] = asset('storage/' . $path);
        }

        // 3. On envoie les données corrigées au Repository
        $item = $this->repository->create($data);

        return response()->json([
            'message' => 'Félicitations, votre service a été créé avec succès !',
            'data' => new ServiceResource($item)
        ], 201);
    }

    public function show(int|string $service): JsonResponse
    {
        return response()->json(new ServiceResource($this->repository->find($service)));
    }

    public function update(UpdateServiceRequest $request, int|string $service): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $data['image'] = asset('storage/' . $path);
        }

        $item = $this->repository->update($service, $data);

        return response()->json([
            'message' => 'Le service a été mis à jour avec succès !',
            'data' => new ServiceResource($item)
        ]);
    }

    public function destroy(int|string $service): JsonResponse
    {
        $this->repository->delete($service);
        // On passe d'un code 204 (vide) à un code 200 pour pouvoir envoyer du JSON
        return response()->json([
            'message' => 'Le service a été définitivement supprimé du serveur.'
        ], 200);
    }
}
