@extends('layouts.app')

@section('title', 'Administration des articles')

@section('content')

<style>
    h1 { text-align: center; }
    table { margin: 0 auto; }
    .status-dot { display:inline-block; width:8px; height:8px; border-radius:50%; margin-right:5px; }
    .status-published { background-color: green; }
    .status-draft { background-color: grey; }
    .pagination { text-align: center; margin-top: 10px; }
    .pagination .disabled { color: #aaa; }
    .alert { text-align:center; padding:10px; margin:10px auto; max-width:400px; }
    .alert-success { background-color:#d4edda; color:#155724; }
</style>

<h1>Administration des articles</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div style="max-width: 700px; margin: 0 auto; text-align: right;">
    <a href="{{ route('admin-articles-create') }}" style="display:inline-block; padding:8px 12px; background-color:#333; color:white; text-decoration:none; margin-bottom:10px;">+ Nouvel article</a>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->category->name }}</td>
                <td>
                    <span class="status-dot status-{{ $article->status }}"></span>
                    {{ $article->status === 'published' ? 'Publié' : 'Brouillon' }}
                </td>
                <td>{{ $article->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin-articles-edit', $article) }}" title="Modifier">✏️</a>

                    @if ($article->status === 'draft')
                        <form action="{{ route('admin-articles-publish', $article) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" title="Publier" style="border:none; background:none; cursor:pointer;">➤</button>
                        </form>
                    @endif

                    <form action="{{ route('admin-articles-destroy', $article) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cet article ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Supprimer" style="border:none; background:none; cursor:pointer;">🗑️</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

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