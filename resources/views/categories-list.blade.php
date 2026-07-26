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
    </style>

    <h1>Liste des catégories</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
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