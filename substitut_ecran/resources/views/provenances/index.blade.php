<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Provenances</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
        }
        .button {
            padding: 8px 12px;
            background-color: #28a745; /* Vert */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
        }
        .button:hover {
            background-color: #218838; /* Vert plus foncé pour le hover */
        }
        .alert {
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #28a745; /* Vert */
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .delete-button, .edit-button {
            background-color: white;
            border: none;
            color: #28a745; /* Vert */
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .delete-button:hover {
            background-color: #c82333; /* Rouge pour la suppression */
            color: white;
        }
        .edit-button:hover {
            background-color: #218838; /* Vert plus foncé pour l'édition */
            color: white;
        }
        .back-button, .add-button {
            position: absolute;
            top: 20px;
            text-decoration: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
        }
        .back-button {
            right: 20px; /* Positionnement en haut à droite */
            background-color: #28a745;
        }
        .back-button:hover {
            background-color: #218838;
        }
        .add-button {
            left: 20px; /* Positionnement en haut à gauche */
            background-color: #28a745;
        }
        .add-button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function confirmDelete(event) {
            // Empêche l'envoi du formulaire si l'utilisateur annule
            if (!confirm('Êtes-vous sûr de vouloir supprimer cette provenance ?')) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Liste des Provenances</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('provenances.create') }}" class="button add-button">Ajout</a>
        <a href="{{ url('/dashboard') }}" class="button back-button">Accueil</a>

        <!-- Liste des provenances -->
        <table>
            <thead>
                <tr>
                    <th>Nom de la Provenance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($provenances as $provenance)
                    <tr>
                        <td>{{ $provenance->provenance_name }}</td>
                        <td>
                            <a href="{{ route('provenances.edit', $provenance->id) }}" class="edit-button" title="Modifier">✏️</a>
                            <form action="{{ route('provenances.destroy', $provenance->id) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button" title="Supprimer">❌</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
