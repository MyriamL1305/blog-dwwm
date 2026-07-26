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
Route::get('articles',Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])->name('admin-articles-list');

//Route pour admin-article
Route::get('/admin/articles/create', [ArticleController::class, 'create'])->name('admin-articles-create');
Route::post('/admin/articles', [ArticleController::class, 'store'])->name('admin-articles-store');
Route::delete('/admin/articles/{article}', [ArticleController::class, 'destroy'])->name('admin-articles-destroy');
Route::patch('/admin/articles/{article}/publish', [ArticleController::class, 'publish'])->name('admin-articles-publish'); [ArticleController::class, 'index'])->name('articles-list');
