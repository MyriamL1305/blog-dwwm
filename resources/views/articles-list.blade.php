@extends('layouts.app')

@section('title', 'Liste des articles')

@section('content')

    <style>
        .filters {
            text-align: center;
            margin-bottom: 20px;
        }
        .article-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 0 auto 15px auto;
            max-width: 700px;
            text-align: left;
        }
        .article-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.9em;
            color: #555;
        }
        .article-title {
            margin: 5px 0;
        }
        .pagination {
            text-align: center;
            margin-top: 10px;
        }
        .pagination .disabled {
            color: #aaa;
        }
    </style>

    <h1 style="text-align: center;">Liste des articles</h1>

    {{-- Filtres : pour l'instant juste affichés, pas encore fonctionnels --}}
    <div class="filters">
        Filtres :
        <select disabled>
            <option>Toutes les catégories</option>
        </select>
        <select disabled>
            <option>Tous les tags</option>
        </select>
    </div>

    @foreach ($articles as $article)
        <div class="article-card">
            <div class="article-meta">
                <span>[ {{ $article->category->name }} ]</span>
                <span>{{ $article->published_at?->format('d/m/Y') ?? $article->created_at->format('d/m/Y') }}</span>
            </div>

            <h2 class="article-title">{{ $article->title }}</h2>

            <p>{{ \Illuminate\Support\Str::limit($article->content, 150) }}</p>

            {{-- Pas encore de lien "Lire" car le slug n'a pas de route associée pour l'instant --}}
            <span style="color: #aaa;">Lire →</span>
        </div>
    @endforeach

    <div class="pagination">
        @if ($articles->onFirstPage())
            <span class="disabled">Précédent</span>
        @else
            <a href="{{ $articles->previousPageUrl() }}">Précédent</a>
        @endif

        <span>Page {{ $articles->currentPage() }} / {{ $articles->lastPage() }}</span>

        @if ($articles->hasMorePages())
            <a href="{{ $articles->nextPageUrl() }}">Suivant</a>
        @else
            <span class="disabled">Suivant</span>
        @endif
    </div>

@endsection