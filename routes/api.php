<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', function (Request $request) {
        $user = $request->user();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role // <-- Lit le vrai rôle en base de données
        ]);
    });
});



    // 1. Route publique : Tout le monde peut envoyer un message depuis la vitrine
    Route::post('/contacts', [ContactController::class, 'store']);

    // 2. Routes sécurisées : Seul l'admin connecté peut lire et supprimer les messages
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/contacts', [ContactController::class, 'index']);
        Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
    });



    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);

    Route::apiResource('produits', \App\Http\Controllers\ProduitController::class);

    Route::apiResource('services', \App\Http\Controllers\ServiceController::class);

    Route::apiResource('element-commandes', \App\Http\Controllers\ElementCommandeController::class);

    Route::apiResource('posts', \App\Http\Controllers\PostController::class);

    Route::apiResource('commandes', \App\Http\Controllers\CommandeController::class);

    // Les routes d'authentification que votre Angular essaie d'appeler
    Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');


