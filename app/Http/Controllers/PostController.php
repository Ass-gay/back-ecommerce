<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private readonly PostRepository $repository) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) ($request->integer('per_page') ?: 15);
        // L'index reste identique pour faciliter la pagination de la collection
        return response()->json(new PostCollection($this->repository->paginate($perPage)));
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        // 1. On récupère les données validées du formulaire
        $data = $request->validated();

        // 2. On vérifie si un fichier image est présent dans la requête
        if ($request->hasFile('image')) {
            // Déplace physiquement le fichier de C:\xampp\tmp vers votre dossier public (storage/app/public/posts)
            $path = $request->file('image')->store('posts', 'public');

            // Remplace le chemin temporaire par l'URL publique accessible par Angular
            // Exemple généré : "http://127.0.0"
            $data['image'] = asset('storage/' . $path);
        }

        // 3. On envoie les données corrigées au Repository
        $item = $this->repository->create($data);

        return response()->json([
            'message' => 'Félicitations, votre post a été créé avec succès !',
            'data' => new PostResource($item)
        ], 201);
    }


    public function show(int|string $post): JsonResponse
    {
        return response()->json(new PostResource($this->repository->find($post)));
    }

    public function update(UpdatePostRequest $request, int|string $post): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = asset('storage/' . $path);
        }

        $item = $this->repository->update($post, $data);

        return response()->json([
            'message' => 'Le post a été mis à jour avec succès !',
            'data' => new PostResource($item)
        ]);
    }


    public function destroy(int|string $post): JsonResponse
    {
        $this->repository->delete($post);
        // On passe d'un code 204 (vide) à un code 200 pour pouvoir envoyer du JSON
        return response()->json([
            'message' => 'Le post a été définitivement supprimé du serveur.'
        ], 200);
    }
}
