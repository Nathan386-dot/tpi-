<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Authentifie l'utilisateur
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentative de connexion
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->authenticated($request, Auth::user());
        }

        // Redirection en cas d'échec avec message d'erreur en français
        return redirect()->back()->withErrors(['email' => 'Email ou Mot de passe incorrect.']);
    }

    // Redirection après connexion
    protected function authenticated(Request $request, $user)
    {
        // Vérifiez si l'utilisateur a un type "user"
        if ($user->usertype === 'user') {
            return redirect()->route('substitut.index'); // Redirige vers la page substitut
        }

        // Rediriger vers la page d'accueil ou une autre destination
        return redirect()->intended('/dashboard');
    }

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Rediriger vers la page de connexion
    }
}
