<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mon Blog')</title>
    {{-- @yield('title', 'Mon Blog') affiche un titre différent selon la page,
         et utilise "Mon Blog" par défaut si la page ne précise rien. --}}
</head>
<body>

    <header>
        <nav>
            <a href="{{ route('categories-list') }}">Catégories</a>
            {{-- Ici tu pourras ajouter d'autres liens de navigation (accueil, articles, etc.) --}}
        </nav>
    </header>

    <main>
        @yield('content')
        {{-- C'est ici que le contenu propre à chaque page viendra s'insérer. --}}
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Mon Blog</p>
    </footer>

</body>
</html>