<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc; /* Couleur de fond */
        }

        .login-container {
            max-width: 350px; /* Réduire la largeur du formulaire */
            margin: 100px auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff; /* Couleur de fond du formulaire */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
            display: flex; /* Utiliser flexbox pour aligner étiquette et champ */
            align-items: center; /* Aligner verticalement au centre */
        }

        label {
            margin-right: 10px; /* Espace entre l'étiquette et le champ */
            font-weight: bold; /* Étiquettes en gras */
            width: 80px; /* Largeur fixe pour les étiquettes */
        }

        input[type="email"],
        input[type="password"] {
            width: 100%; /* S'assurer que les champs prennent toute la largeur */
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block; /* Bloquer les champs pour les rendre centrés */
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50; /* Couleur du bouton */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #45a049; /* Couleur du bouton au survol */
        }

        /* Style pour l'image */
        .logo {
            text-align: center;
            margin-bottom: 10px; /* Espace entre l'image et le titre */
        }

        .logo img {
            width: 100px; /* Taille de l'image */
        }

        .error-message {
            color: red; /* Couleur des messages d'erreur */
            text-align: center; /* Centrer le message d'erreur */
            margin-bottom: 15px; /* Marge sous le message d'erreur */
        }

        /* Styles pour le footer */
        .footer {
            text-align: center; /* Centrer le texte du footer */
            margin-top: 20px; /* Espace au-dessus du footer */
            font-size: 12px; /* Taille de police réduite pour le footer */
            color: #666; /* Couleur du texte du footer */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('favicon.png') }}" alt="Logo"> <!-- Ajout de l'image -->
        </div>
        <h2>Connexion</h2>

        <!-- Afficher le message d'erreur s'il y en a un -->
        @if ($errors->any())
            <div class="error-message">
                Email ou Mot de passe incorrecte.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Entrez votre email" required autofocus>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
    <div class="footer">
        En cas d'oublie de mot de passe, veuillez contacter le responsable.
    </div>
</body>
</html>
