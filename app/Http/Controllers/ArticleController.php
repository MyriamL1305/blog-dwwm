<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category'])->paginate(10);
        // ->with(['category', 'user']) charge en même temps la catégorie de chaque article

        return view('articles-list', [
            'articles' => $articles,
        ]);
    }
}