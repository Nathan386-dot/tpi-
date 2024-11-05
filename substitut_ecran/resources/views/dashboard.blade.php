<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 60px; /* Pour éviter le chevauchement avec la navbar */
            transition: transform 0.3s ease;
            transform: translateX(-250px);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
        }

        /* Content styling */
        .content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 70px; /* Ajuste la marge pour tenir compte de la navbar fixe */
            transition: margin-left 0.3s ease;
        }

        .content.shifted {
            margin-left: 0;
        }

        /* Navbar adjustments */
        .navbar {
            z-index: 1000;
        }

        /* Styles du modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.7); /* Background color with opacity */
            transition: opacity 0.3s ease; /* Fade effect */
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto; /* 10% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            border-radius: 10px; /* Rounded corners */
            width: 80%; /* Could be more or less, depending on screen size */
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2); /* Shadow effect */
            animation: slideIn 0.4s; /* Animation */
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Styles des boutons */
        .button {
            background-color: #28a745; /* Vert pour le bouton d'inscription */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px; /* Rounded corners */
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition */
        }

        .button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        /* Styles des champs de formulaire */
        .form-group {
            margin-bottom: 15px; /* Space between form groups */
        }

        .form-group label {
            display: block; /* Ensure labels are on separate lines */
            margin-bottom: 5px; /* Space between label and input */
        }

        .form-group input {
            width: 100%; /* Full width for inputs */
            padding: 10px; /* Padding inside the input */
            border: 1px solid #ccc; /* Border color */
            border-radius: 5px; /* Rounded corners */
            transition: border-color 0.3s; /* Smooth transition */
        }

        .form-group input:focus {
            border-color: #28a745; /* Change border color on focus */
            outline: none; /* Remove outline */
        }

        /* Styles pour le message d'erreur */
        .error-message {
            color: red; /* Couleur rouge pour les messages d'erreur */
            margin-top: 10px; /* Espacement au-dessus du message */
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <button class="btn btn-dark" id="sidebarToggle">☰</button>
            <a class="navbar-brand ms-3" href="#">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <button class="btn btn-success ms-auto" id="addUserButton">Ajouter un Substitut</button> <!-- Bouton pour ouvrir le modal -->
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="{{ route('profile.edit') }}">Profil</a></li> <!-- Lien vers la page de profil -->
            <li><a href="{{ route('provenances.index') }}">Provenance</a></li> <!-- Lien vers la page de provenance -->
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a></li> <!-- Lien de déconnexion -->
        </ul>
    </div>

    <!-- Content -->
    <div class="content" id="content">
        @include('users.index') <!-- Assurez-vous que ce fichier est accessible et bien configuré -->
    </div>

    <!-- Formulaire de déconnexion -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Modal pour ajouter un substitut -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter un Substitut</h2>
            <form id="addUserForm" action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="door_number">Numéro de Porte :</label>
                    <input type="text" name="door_number" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe : (8 caractères minimum)</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe :</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>
                <div id="error-message" class="error-message" style="display:none;">Revérifiez votre mot de passe</div> <!-- Message d'erreur -->
                <button type="submit" class="button" id="submitButton">Inscrire</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const addUserButton = document.getElementById('addUserButton');
        const modal = document.getElementById('myModal');
        const closeModal = document.getElementsByClassName('close')[0];
        const errorMessage = document.getElementById('error-message');

        // Ouvrir le modal
        addUserButton.onclick = function() {
            modal.style.display = "block";
        }

        // Fermer le modal
        closeModal.onclick = function() {
            modal.style.display = "none";
            resetForm();
        }

        // Fermer le modal en cliquant à l'extérieur
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                resetForm();
            }
        }

        // Gérer l'ouverture/fermeture de la sidebar
        sidebarToggle.onclick = function() {
            sidebar.classList.toggle('active');
            content.classList.toggle('shifted');
        }

        // Vérifiez les mots de passe avant de soumettre le formulaire
        document.getElementById('addUserForm').onsubmit = function(event) {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                event.preventDefault(); // Empêcher la soumission du formulaire
                errorMessage.style.display = 'block'; // Afficher le message d'erreur
            } else {
                errorMessage.style.display = 'none'; // Cacher le message d'erreur
            }
        }

        function resetForm() {
            document.getElementById('addUserForm').reset();
            errorMessage.style.display = 'none'; // Cacher le message d'erreur
        }
    </script>
</body>
</html>
