<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File d'attente</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Fond de la page en noir */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff; /* Fond du conteneur principal en blanc */
            color: #000; /* Couleur du texte dans le conteneur en noir */
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
        }

        h1 {
            text-align: center;
            margin-bottom: 1rem;
            text-decoration: none; /* Enlève le soulignement sous le titre */
        }

        ul {
            list-style-type: none; /* Supprime les puces de la liste */
            padding: 0;
        }

        li {
            background-color: #fff; /* Fond de chaque ligne en blanc */
            margin-bottom: 10px;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
            color: #000; /* Couleur du texte dans les lignes en noir */
        }

        .delete-button {
            border: none; /* Supprime la bordure */
            background-color: red; /* Couleur de fond */
            color: white; /* Couleur du texte */
            cursor: pointer; /* Curseur en forme de main */
            padding: 5px 10px; /* Espacement intérieur */
            border-radius: 5px; /* Coins arrondis */
            outline: none; /* Enlève le contour lorsqu'on clique sur le bouton */
        }

        .delete-button:hover {
            background-color: darkred;
        }

        .back-button {
            background-color: #28a745; /* Couleur verte pour le bouton retour */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            margin-top: 20px; /* Ajoute un espacement au-dessus du bouton retour */
        }

        .back-button:hover {
            background-color: #218838; /* Couleur verte plus foncée au survol */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>File d'attente</h1>
        
        <!-- Vérifiez s'il y a des entrées dans la file d'attente -->
        @if($fileAttente->isEmpty())
            <p>Aucune entrée dans la file d'attente pour le moment.</p>
        @else
            <ul>
                @foreach($fileAttente as $item)
                    <li>
                        <span>Numéro d'appel : {{ $item->numero_appel }} - Numéro de porte : {{ $item->door_number }}</span>
                        <form action="{{ route('substitut.file_d_attente.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">✖</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('substitut.index') }}" class="back-button">Retour</a>
    </div>
</body>
</html>
