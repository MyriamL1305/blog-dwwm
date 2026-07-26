<?php

namespace App\Models;
// Indique où se trouve ce fichier dans l'organisation du projet (obligatoire dans Laravel, généré automatiquement).

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Importe un "trait" (un ensemble de fonctionnalités toutes prêtes) qui sert à générer
// de fausses données de test pour cette table plus tard. On l'importe pour pouvoir
// l'utiliser plus bas dans la classe.

use Illuminate\Database\Eloquent\Model;
// Importe la classe de base "Model" fournie par Laravel. Tous les modèles Laravel
// héritent de cette classe : c'est elle qui donne accès à toutes les fonctions
// magiques (trouver un enregistrement, le sauvegarder, le supprimer, etc.).

use Illuminate\Database\Eloquent\Relations\HasMany;
// Importe le type de relation "HasMany" (= "a plusieurs"), qu'on utilise plus bas
// pour dire "une catégorie a plusieurs articles".

class Category extends Model
{
    // "extends Model" veut dire que notre classe Category hérite de toutes les
    // fonctionnalités de la classe Model importée juste au-dessus.

    use HasFactory;
    // Ici, on active le trait HasFactory à l'intérieur de la classe : ça ajoute
    // des méthodes toutes prêtes à Category, sans qu'on ait à les écrire nous-même.

    protected $fillable = [
        'name',
        'slug',
    ];
    // Cette liste dit à Laravel : "ces colonnes peuvent être remplies directement
    // depuis un formulaire (via Category::create([...]))". C'est une sécurité :
    // sans ça, Laravel refuse de remplir des colonnes en masse par précaution.

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
    // Cette fonction définit le lien avec la table "articles". Elle dit :
    // "une catégorie peut avoir plusieurs articles liés à elle".
    // Grâce à ça, tu pourras écrire par exemple : $category->articles
    // pour récupérer tous les articles d'une catégorie.
}