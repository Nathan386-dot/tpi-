<div class="container">
    <h1>Liste des Utilisateurs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Numéro de Porte</th> <!-- Nouvelle colonne ajoutée -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->door_number }}</td> <!-- Affichage du numéro de porte -->
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Modifier</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(event) {
        // Affiche une boîte de confirmation
        if (!confirm('Êtes-vous sûr de vouloir supprimer cet substitut ?')) {
            event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur annule
        }
    }
</script>
