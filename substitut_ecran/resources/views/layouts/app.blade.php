{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    @vite(['resources/js/app.js', 'resources/css/app.css']) {{-- Assurez-vous que votre fichier JS et CSS est inclus --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> {{-- Si vous avez un fichier CSS personnalisé --}}
</head>
<body>
    <div class="container">
        {{-- Navbar --}}
        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li><a href="{{ route('users.index') }}">Utilisateurs</a></li>
                    <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                </ul>
            </nav>
        </header>

        {{-- Sidebar --}}
        <aside>
            <ul>
                <li><a href="{{ route('substitut.index') }}">Substituts</a></li>
                <li><a href="{{ route('provenance.store') }}">Provenance</a></li>
            </ul>
        </aside>

        <!-- Page Content -->
        <main>
            @yield('content') {{-- Remplacez {{ $slot }} par @yield('content') --}}
        </main>
    </div>
</body>
</html>
