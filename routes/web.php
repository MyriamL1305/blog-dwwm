<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

//Route pour Category
    //Route pour la vue principale de la liste de catégories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories-list');
    //Route pour la créatiion d'une catégorie get et post
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories-create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories-store');
    //Route pour la suppression d'une categorie
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories-destroy');    


//Route pour Article
Route::get('articles', [ArticleController::class, 'index'])->name('articles-list');