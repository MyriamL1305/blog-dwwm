<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// On importe le modèle Category pour pouvoir aller chercher les catégories en base de données.

class CategoryController extends Controller
{
    public function index() : View
    {
        $categories = Category::withCount('articles')->paginate(10);
        // Category::paginate()10 récupère 10 lignes de la table categories
        // et les transforme en une collection d'objets Category pour faire la pagination.

        return view('categories-list', [
            'categories' => $categories,
        ]);
        // On renvoie la vue "categories/index.blade.php" (le point remplace le slash
        // dans le chemin du dossier resources/views), en lui transmettant la variable
        // $categories pour qu'elle puisse s'en servir dans le HTML.
    }

    public function create()
{
    return view('categories-create');
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('categories-list')->with('success', 'Catégorie créée.');
    }


    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories-list')->with('success', 'Catégorie supprimée.');
        } catch (QueryException $e) {
            return redirect()->route('categories-list')->with('error', 'Impossible de supprimer cette catégorie : des articles y sont encore associés.');
        }
    }
}
