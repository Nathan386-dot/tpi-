<?php

namespace App\Http\Controllers;

use App\Models\Substitut;
use App\Models\OPJ; // Assurez-vous d'importer le modèle OPJ
use App\Models\FileDAttente; // Import du modèle FileDAttente
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubstitutController extends Controller
{
    // Afficher la liste des OPJs
    public function index()
    {
        $opjs = OPJ::all(); // Récupérer tous les OPJs
        $user = Auth::user(); // Récupérer l'utilisateur connecté
        
        // Vérifiez si l'utilisateur est bien du type 'user'
        if ($user->usertype !== 'user') {
            return redirect('/')->with('error', 'Accès refusé.');
        }

        // Passez $opjs à la vue
        return view('substitut.index', compact('user', 'opjs'));
    }

    // Gérer la prise en charge des OPJs sélectionnés
    public function takeCharge(Request $request)
    {
        // Valider que des OPJs ont été sélectionnés
        $request->validate([
            'opjs' => 'required|array',
            'opjs.*' => 'exists:opj,id', // Valider que chaque OPJ existe dans la table opj
        ]);

        foreach ($request->opjs as $opjId) {
            // Récupérer l'OPJ
            $opj = OPJ::findOrFail($opjId);

            // Créer un nouvel enregistrement dans la table file_d_attente
            FileDAttente::create([
                'provenance' => $opj->provenance,
                'role' => $opj->role,
                'door_number' => Auth::user()->door_number, // Utiliser le door_number de l'utilisateur
                'numero_appel' => $opj->numero_appel,
            ]);

            // Supprimer l'OPJ de la table opj
            $opj->delete();
        }

        // Rediriger avec un message de succès
        return redirect()->route('substitut.index')->with('success', 'OPJs pris en charge avec succès.');
    }

    // Afficher la page pour libérer les OPJs
    public function liberate()
    {
        $user = Auth::user();

        // Récupérer la liste des OPJs en file d'attente
        $fileDAttente = FileDAttente::where('door_number', $user->door_number)->get();

        return view('substitut.liberate', compact('fileDAttente'));
    }

    // Libérer un OPJ spécifique
    public function release($id)
    {
        $fileDAttente = FileDAttente::findOrFail($id);
        $fileDAttente->delete();

        return redirect()->route('substitut.liberate')->with('success', 'OPJ libéré avec succès.');
    }

    // Afficher la file d'attente
    public function showQueue()
    {
        // Récupérer les données du tableau file_d_attente
        $fileAttente = DB::table('file_d_attente')->get();

        // Retourner la vue avec les données récupérées
        return view('substitut.file_attente', ['fileAttente' => $fileAttente]);
    }

    // Supprimer une entrée de la file d'attente
    public function destroy($id)
    {
        // Trouvez le fichier d'attente par ID et supprimez-le
        $fileDAttente = FileDAttente::findOrFail($id);
        $fileDAttente->delete();

        // Rediriger avec un message de succès
        return redirect()->route('substitut.file_d_attente')->with('success', 'Entrée supprimée avec succès.');
    }

    // Afficher la page de modification du profil
    public function edit()
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté
        return view('substitut.profil', compact('user'));
    }

    // Méthode pour mettre à jour le profil
    public function update(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'door_number' => 'required|numeric',
            'password' => 'nullable|confirmed|min:8',
        ], [
            'password.confirmed' => 'Revérifiez votre nouveau mot de passe.', // Message d'erreur personnalisé
        ]);

        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Mettre à jour les informations sauf le mot de passe
        $user->update($request->except('password'));

        // Si un nouveau mot de passe est fourni, on le crypte et on le met à jour
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // Redirection avec un message de succès
        return redirect()->route('substitut.profil')->with('success', 'Profil mis à jour avec succès.');
    }
}
