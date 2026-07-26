<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function adminIndex()
{
    $articles = Article::with('category')->orderBy('created_at', 'desc')->paginate(10);

    return view('admin-articles-list', [
        'articles' => $articles,
    ]);
}

public function create()
{
    $categories = Category::all();

    return view('admin-articles-form', [
        'categories' => $categories,
        'article' => new Article(),
    ]);
}

public function edit(Article $article)
{
    $categories = Category::all();

    return view('admin-articles-form', [
        'categories' => $categories,
        'article' => $article,
    ]);
}

public function update(Request $request, Article $article)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required|string',
        'status' => 'required|in:draft,published',
    ]);

    $article->update([
        'title' => $validated['title'],
        'slug' => Str::slug($validated['title']),
        'category_id' => $validated['category_id'],
        'content' => $validated['content'],
        'status' => $validated['status'],
        'published_at' => $validated['status'] === 'published' ? ($article->published_at ?? now()) : null,
    ]);

    return redirect()->route('admin-articles-list')->with('success', 'Article modifié.');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required|string',
        'status' => 'required|in:draft,published',
    ]);

    Article::create([
        'title' => $validated['title'],
        'slug' => Str::slug($validated['title']),
        'category_id' => $validated['category_id'],
        'content' => $validated['content'],
        'status' => $validated['status'],
        'published_at' => $validated['status'] === 'published' ? now() : null,
        'user_id' => User::first()->id, // temporaire, en attendant l'authentification
    ]);

    return redirect()->route('admin-articles-list')->with('success', 'Article créé.');
}

public function destroy(Article $article)
{
    $article->delete();

    return redirect()->route('admin-articles-list')->with('success', 'Article supprimé.');
}

public function publish(Article $article)
{
    $article->update([
        'status' => 'published',
        'published_at' => $article->published_at ?? now(),
    ]);

    return redirect()->route('admin-articles-list')->with('success', 'Article publié.');
}

}