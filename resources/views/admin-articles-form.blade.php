@extends('layouts.app')

@section('title', $article->exists ? "Modifier l'article" : 'Nouvel article')

@section('content')

<h1 style="text-align:center;">{{ $article->exists ? "Modifier l'article" : 'Nouvel article' }}</h1>

<div style="max-width: 500px; margin: 0 auto; text-align: left;">

    @if ($errors->any())
        <div style="background-color:#f8d7da; color:#721c24; padding:10px; margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $article->exists ? route('admin-articles-update', $article) : route('admin-articles-store') }}" method="POST">
        @csrf
        @if ($article->exists)
            @method('PUT')
        @endif

        <label for="title">Titre :</label><br>
        <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" style="width:100%; padding:6px; margin:6px 0;">
        <br><br>

        <label for="category_id">Catégorie :</label><br>
        <select id="category_id" name="category_id" style="width:100%; padding:6px; margin:6px 0;">
            <option value="">Sélectionner une catégorie</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label for="content">Contenu :</label><br>
        <textarea id="content" name="content" rows="6" style="width:100%; padding:6px; margin:6px 0;">{{ old('content', $article->content) }}</textarea>
        <br><br>

        <label>Statut :</label><br>
        <label><input type="radio" name="status" value="draft" {{ old('status', $article->status ?? 'draft') == 'draft' ? 'checked' : '' }}> Brouillon</label>
        <label><input type="radio" name="status" value="published" {{ old('status', $article->status) == 'published' ? 'checked' : '' }}> Publié</label>
        <br><br>

        <button type="submit">Enregistrer</button>
        <a href="{{ route('admin-articles-list') }}">Annuler</a>
    </form>

</div>

@endsection