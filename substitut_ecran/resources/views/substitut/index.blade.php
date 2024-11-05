<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des OPJ</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Fond noir */
            margin: 0;
            height: 100vh; /* Hauteur de la vue */
            display: flex; /* Utilisation de Flexbox */
            justify-content: center; /* Centrer horizontalement */
            align-items: center; /* Centrer verticalement */
        }

        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 90%; /* Largeur de la conteneur */
            max-width: 800px; /* Largeur maximum de la conteneur */
            height: 100%; /* Prendre toute la hauteur de l'écran */
            display: flex;
            flex-direction: column;
            position: relative; /* Pour positionner le nom et les boutons */
        }

        .header {
            display: flex;
            justify-content: space-between; /* Pour espacer le nom et les boutons */
            align-items: center;
            margin-bottom: 1.5rem;
            position: sticky; /* Rendre l'en-tête collant */
            top: 0; /* Positionner en haut */
            background: white; /* Fond blanc pour l'en-tête */
            z-index: 10; /* Placer au-dessus du contenu */
        }

        h1 {
            text-align: center;
            margin: 1rem 0; /* Marges autour du titre */
        }

        .message, .error-message {
            margin-bottom: 1rem;
            text-align: center;
        }

        .message {
            color: green;
        }

        .error-message {
            color: red;
        }

        .button-container {
            display: flex;
            gap: 1rem;
        }

        .button {
            background-color: #dc3545; /* Couleur rouge pour déconnexion */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .button.file-queue {
            background-color: #218838; /* Couleur verte plus foncée pour File d'attente */
        }

        .button.profile {
            background-color: #008000; /* Couleur bleue pour le bouton Profil */
        }

        .button:hover {
            opacity: 0.8;
        }

        .opj-list {
            overflow-y: auto; /* Permettre le défilement vertical */
            max-height: 60vh; /* Limiter la hauteur pour le défilement */
            padding-bottom: 1rem; /* Ajouter un peu d'espace en bas */
        }

        .opj-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .opj-item:last-child {
            border-bottom: none;
        }

        .submit-button {
            background-color: #28a745; /* Couleur verte */
            color: white;
            border: none;
            padding: 1rem 2rem; /* Augmenter la taille du bouton */
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem; /* Augmenter la taille de la police */
            display: block;
            margin: 2rem auto 0 auto; /* Centrer le bouton horizontalement */
        }

        .submit-button:hover {
            background-color: #218838; /* Couleur verte plus foncée au survol */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="user-info">
                <strong>{{ $user->name }}</strong> - Porte N°: {{ $user->door_number }}
            </div>

            <div class="button-container">
                <a href="{{ route('substitut.file_d_attente') }}" class="button file-queue">File d'attente</a>
                <a href="{{ route('substitut.profil') }}" class="button profile">Profil</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="button">Déconnexion</button>
                </form>
            </div>
        </div>

        <h1>Liste des OPJ en attente</h1>

        @if (session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <form action="{{ route('substitut.take_charge') }}" method="POST">
            @csrf
            <div class="opj-list" id="opj-list">
                @if($opjs->isEmpty())
                    <p>Aucun OPJ disponible pour le moment.</p>
                @else
                    @foreach($opjs as $opj)
                        <div class="opj-item">
                            <span>Provenance: {{ $opj->provenance }} (N°appel: {{ $opj->numero_appel }})</span>
                            <input type="checkbox" name="opjs[]" value="{{ $opj->id }}">
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="submit" class="submit-button">Prendre en charge les sélectionnés</button>
        </form>
    </div>
</body>
</html>
