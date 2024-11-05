<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bienvenue</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Nunito', sans-serif;
                background-color: #f3f4f6;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                color: #2d3748;
            }
            .container {
                text-align: center;
                background-color: white;
                padding: 50px;
                border-radius: 12px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            .container h1 {
                font-size: 3rem;
                color: #1a202c;
                margin-bottom: 20px;
            }
            .container p {
                font-size: 1.2rem;
                color: #4a5568;
            }
            .button-group {
                margin-top: 30px;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                font-size: 1rem;
                border-radius: 8px;
                color: white;
                background-color: #4a5568;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }
            .btn:hover {
                background-color: #2d3748;
            }
            .login-btn {
                background-color: #3182ce;
            }
            .login-btn:hover {
                background-color: #2b6cb0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Bienvenue à vous cher Substitut</h1>
            <p>Gérez facilement la prise ne charge des opj en vous connectant.</p>
            
            @if (Route::has('login'))
                <div class="button-group">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn">Accéder au Tableau de Bord</a>
                    @else
                        <a href="{{ route('login') }}" class="btn login-btn">Se connecter</a>
                        {{-- Le lien d'enregistrement est réservé aux admins dans le dashboard --}}
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
