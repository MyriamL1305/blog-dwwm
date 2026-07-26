@extends('layouts.app')

@section('title', 'Liste des catégories')

@section('content')

    <style>
        h1 {
            text-align: center;
        }
        table {
            margin: 0 auto;
        }
        .pagination {
            text-align: center;
            margin-top: 10px;
        }
        .pagination .disabled {
            color: #aaa;
        }
        .alert {
            text-align: center;
            padding: 10px;
            margin: 10px auto;
            max-width: 400px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>

    <h1>Liste des catégories</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div style="max-width: 400px; margin: 0 auto; text-align: right;">
        <a href="{{ route('categories-create') }}" style="display: inline-block; padding: 8px 12px; background-color: #333; color: white; text-decoration: none; margin-bottom: 10px;">+ Catégorie</a>
    </div>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre d'articles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->articles_count }}</td>
                    <td>
                        <form action="{{ route('categories-destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        @if ($categories->onFirstPage())
            <span class="disabled">Précédent</span>
        @else
            <a href="{{ $categories->previousPageUrl() }}">Précédent</a>
        @endif

        <span>Page {{ $categories->currentPage() }} / {{ $categories->lastPage() }}</span>

        @if ($categories->hasMorePages())
            <a href="{{ $categories->nextPageUrl() }}">Suivant</a>
        @else
            <span class="disabled">Suivant</span>
        @endif
    </div>

@endsection