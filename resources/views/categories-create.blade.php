@extends('layouts.app')

@section('title', 'Créer une catégorie')

@section('content')

    <h1 style="text-align:center;">Créer une catégorie</h1>

    <div style="max-width: 400px; margin: 0 auto; text-align: left;">

        @if ($errors->any())
            <div style="background-color:#f8d7da; color:#721c24; padding:10px; margin-bottom:10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories-store') }}" method="POST">
            @csrf

            <label for="name">Nom de la catégorie :</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" style="width:100%; padding:6px; margin:6px 0;">
            <br><br>

            <button type="submit">Créer</button>
        </form>

    </div>

@endsection