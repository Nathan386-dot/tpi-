<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Substitut</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            color: #2c3e50;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        h1 {
            text-align: center;
            font-size: 2.2em;
            margin-bottom: 30px;
            color: #34495e;
        }
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 10px;
            color: #34495e;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced6e0;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
            font-size: 16px;
        }
        input[type="text"]:focus, input[type="email"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        .checkbox-label {
            display: inline-flex;
            align-items: center;
            color: #34495e;
            margin-top: 15px;
            font-size: 16px;
        }
        .checkbox-label input {
            margin-left: 10px;
            transform: scale(1.2);
        }
        .button {
            width: 100%;
            padding: 15px;
            background-color: #28a745;;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
            margin-top: 15px;
        }
        .button:hover {
            background-color: #218838;
        }
        .button:active {
            transform: scale(0.98);
        }
        .cancel-button {
            background-color: #e74c3c;
        }
        .cancel-button:hover {
            background-color: #c0392b;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #95a5a6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier le Substitut</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>

            <label for="door_number">Numéro de Porte</label>
            <input type="text" id="door_number" name="door_number" value="{{ old('door_number', $user->door_number) }}" required>

            <label class="checkbox-label">
                Réinitialiser le mot de passe à "11111111"
                <input type="checkbox" name="reset_password" value="1">
            </label>

            <button type="submit" class="button">Mettre à jour</button>
        </form>

        <button class="button cancel-button" onclick="window.location.href='/dashboard'">Annuler</button>

        <div class="footer">
            <p>Modification pour le substitut</p>
        </div>
    </div>
</body>
</html>
