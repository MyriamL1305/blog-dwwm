<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

// On importe le modèle Category pour pouvoir aller chercher les catégories en base de données.

class CategoryController extends Controller
{
    public function index() : View
    {
        $categories = Category::paginate(10);
        // Category::paginate()10 récupère 10 lignes de la table categories
        // et les transforme en une collection d'objets Category pour faire la pagination.

        return view('categories-list', [
            'categories' => $categories,
        ]);
        // On renvoie la vue "categories/index.blade.php" (le point remplace le slash
        // dans le chemin du dossier resources/views), en lui transmettant la variable
        // $categories pour qu'elle puisse s'en servir dans le HTML.
    }
}
