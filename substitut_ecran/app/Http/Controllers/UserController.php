<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Provenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Afficher la liste des utilisateurs
    public function index()
    {
        // Récupérer uniquement les utilisateurs avec usertype = 'user'
        $users = User::where('usertype', 'user')->get();
        $provenances = Provenance::all();

        return view('dashboard', compact('users', 'provenances'));
    }

    // Ajouter un nouvel utilisateur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'door_number' => 'required|string|max:10',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'door_number' => $validated['door_number'],
            'password' => Hash::make($validated['password']),
            'usertype' => 'user',
        ]);

        return redirect()->route('dashboard')->with('success', 'Substitut bien enregistré.');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Modifier un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'door_number' => 'required|string|max:10',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        
        // Mettre à jour les champs
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->door_number = $validated['door_number'];
        
        // Vérifier si la case de réinitialisation du mot de passe est cochée
        if ($request->has('reset_password')) {
            $user->password = Hash::make('11111111'); // Réinitialiser le mot de passe
        } elseif ($request->filled('password')) {
            // Mettre à jour le mot de passe uniquement si un nouveau mot de passe a été fourni
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Utilisateur mis à jour avec succès.');
    }

}
