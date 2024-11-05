<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<div class="container">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            color: #fff;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-home {
            background-color: #218838; /* Plus foncé que le bouton "Mettre à Jour" */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            position: absolute;
            top: 10px;
            right: 10px; /* Alignement à droite */
            text-decoration: none;
            display: inline-block;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: #fff;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-success:hover, .btn-home:hover, .btn-danger:hover {
            opacity: 0.9;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>

    <!-- Bouton "Accueil" en haut à droite -->
    <a href="/dashboard" class="btn-home">Accueil</a>

    <h2 class="text-center">Modifier votre Profil</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse E-mail</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="current_password" class="form-label">Mot de Passe Actuel</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau Mot de Passe (8 caractères minimum)</label>
            <input type="password" id="password" name="password" class="form-control">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le Mot de Passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Mettre à Jour</button>
    </form>

    <hr>

    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer Mon Compte</button>
    </form>
</div>
