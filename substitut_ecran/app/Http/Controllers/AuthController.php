<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Importer la classe Hash
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Vérifier si l'utilisateur existe
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withErrors([
                'error' => 'Mot de passe ou Mail erroné'
            ])->withInput();
        }

        return redirect()->intended('substitut'); // Rediriger vers la page des substituts ou une autre page
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'door_number' => 'required|string|max:10', // Assurez-vous que ce champ existe dans la table users
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'door_number' => $request->door_number,
            'password' => Hash::make($request->password), // Utiliser Hash pour hacher le mot de passe
        ]);

        Auth::login($user); // Connecte l'utilisateur après l'inscription

        return redirect('/substitut')->with('message', 'Inscription réussie. Bienvenue !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('message', 'Vous avez été déconnecté.');
    }
}
