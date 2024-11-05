<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #333;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        .btn-primary {
            background-color: #008000;
            border-color: #008000;
            padding: 10px 20px;
            font-size: 1.1rem;
        }

        .btn-primary:hover {
            background-color: #006600; /* A darker green */
            border-color: #006600;
        }

        .alert-success {
            font-size: 1rem;
        }

        .footer-text {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #888;
        }

        .btn-secondary {
            background-color: #E63946;
            border-color: #E63946;
            padding: 10px 20px;
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background-color: #D62839;
            border-color: #D62839;
        }

        /* Style pour le message d'erreur */
        .error-message {
            color: red;
            font-size: 0.9rem;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Modifier Profil</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->has('password'))
        <div class="alert alert-danger error-message">{{ $errors->first('password') }}</div>
    @endif

    <form action="{{ route('substitut.profil.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="door_number">Porte</label>
            <input type="text" name="door_number" id="door_number" class="form-control" value="{{ $user->door_number }}" required>
        </div>

        <div class="form-group">
            <label for="password">Nouveau Mot de Passe (8 caractères minimum)</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Laissez vide si inchangé">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmer le Mot de Passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmez le mot de passe">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Mettre à jour</button>
    </form>

    <!-- Button Retour -->
    <a href="/substitut" class="btn btn-secondary btn-block">Retour</a>

    <div class="footer-text">
        <p>Vous pouvez modifier votre nom, adresse email, porte, et mot de passe ici.</p>
    </div>
</div>

</body>
</html>
