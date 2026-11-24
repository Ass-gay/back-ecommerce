<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\ProduitRepository;
use App\Http\Requests\Produit\StoreProduitRequest;
use App\Http\Requests\Produit\UpdateProduitRequest;
use App\Http\Resources\ProduitResource;
use App\Http\Resources\ProduitCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function __construct(private readonly ProduitRepository $repository) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) ($request->integer('per_page') ?: 15);
        return response()->json(new ProduitCollection($this->repository->paginate($perPage)));
    }

    public function store(StoreProduitRequest $request): JsonResponse
    {
        // 1. On récupère les données validées du formulaire
        $data = $request->validated();

        // 2. On vérifie si un fichier image est présent dans la requête
        if ($request->hasFile('image')) {
            // Déplace physiquement le fichier de C:\xampp\tmp vers votre dossier public (storage/app/public/produit)
            $path = $request->file('image')->store('produits', 'public');

            // Remplace le chemin temporaire par l'URL publique accessible par Angular
            // Exemple généré : "http://127.0.0"
            $data['image'] = asset('storage/' . $path);
        }

        // 3. On envoie les données corrigées au Repository
        $item = $this->repository->create($data);

        return response()->json([
            'message' => 'Félicitations, votre produit a été créé avec succès !',
            'data' => new ProduitResource($item)
        ], 201);
    }

    public function show(int|string $produit): JsonResponse
    {
        return response()->json(new ProduitResource($this->repository->find($produit)));
    }

    public function update(UpdateProduitRequest $request, int|string $produit): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produits', 'public');
            $data['image'] = asset('storage/' . $path);
        }

        $item = $this->repository->update($produit, $data);

        return response()->json([
            'message' => 'Le produit a été mis à jour avec succès !',
            'data' => new ProduitResource($item)
        ]);
    }

    public function destroy(int|string $produit): JsonResponse
    {
        $this->repository->delete($produit);
        // On passe d'un code 204 (vide) à un code 200 pour pouvoir envoyer du JSON
        return response()->json([
            'message' => 'Le produit a été définitivement supprimé du serveur.'
        ], 200);
    }
}
