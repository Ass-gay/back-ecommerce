<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);

    Route::apiResource('services', \App\Http\Controllers\ServiceController::class);

    Route::apiResource('produits', \App\Http\Controllers\ProduitController::class);

    Route::apiResource('element-commandes', \App\Http\Controllers\ElementCommandeController::class);

    Route::apiResource('posts', \App\Http\Controllers\PostController::class);

    Route::apiResource('commandes', \App\Http\Controllers\CommandeController::class);

require __DIR__.'/auth.php';
