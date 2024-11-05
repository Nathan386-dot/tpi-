<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Provenance</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Permet de positionner le bouton "Retour" */
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .button {
            display: inline-block;
            background-color: red; /* Couleur rouge pour le bouton "Retour" */
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            position: absolute; /* Positionnement absolu pour placer le bouton en haut à droite */
            top: 20px;
            right: 20px;
        }
        .button:hover {
            background-color: darkred; /* Couleur plus foncée au survol */
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/provenances') }}" class="button">Retour</a> <!-- Bouton "Retour" en haut à droite -->
        <h1>Modifier la Provenance</h1>

        <form action="{{ route('provenances.update', $provenance->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="provenance_name">Nom de la Provenance</label>
                <input type="text" id="provenance_name" name="provenance_name" value="{{ $provenance->provenance_name }}" required>
            </div>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
