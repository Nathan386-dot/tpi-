<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opj;
use App\Models\Provenance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OPJController extends Controller
{
    // Méthode index pour afficher la liste des OPJs
    public function index()
    {
        // Récupérer tous les OPJs depuis la base de données
        $opjs = Opj::all();
        $provenances = Provenance::pluck('provenance_name');
        // Retourner la vue avec la liste des OPJs
        return view('opj.index', compact('opjs', 'provenances'));
    }

    // Méthode pour enregistrer un nouvel OPJ
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'provenance' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        // Génération d'un numéro d'appel unique pour l'OPJ
        $numero_appel = $this->generateNumeroAppel();

        // Vérifiez si le numéro d'appel a pu être généré
        if ($numero_appel === null) {
            return redirect()->route('opj.index')->withErrors(['error' => 'Tous les numéros d\'appel ont été utilisés aujourd\'hui.']);
        }

        // Création d'un nouvel OPJ avec le numéro d'appel et status non pris en charge
        $opj = Opj::create([
            'provenance' => $request->input('provenance'),
            'role' => $request->input('role'),
            'numero_appel' => $numero_appel,
            'is_taken' => 0, // Définit l'OPJ comme non pris en charge
        ]);

        // Compte des OPJs non pris en charge
        $nombreNonPriseEnCharge = Opj::where('is_taken', 0)->count();

        // Redirection vers la page d'accueil des OPJs avec un message de succès
        return redirect()->route('opj.index')->with([
            'success' => 'OPJ ajouté avec succès.',
            'numero_appel' => $numero_appel,
            'nombreNonPriseEnCharge' => $nombreNonPriseEnCharge, // Passer le nombre ici
        ]);
    }

    // Méthode pour générer un numéro d'appel unique
    private function generateNumeroAppel()
    {
        // Récupérer le dernier numéro d'appel utilisé
        $lastNumeroAppel = Opj::max('numero_appel');

        // Si aucun numéro n'a été utilisé, commencer à 1
        if ($lastNumeroAppel === null) {
            return str_pad(1, 3, '0', STR_PAD_LEFT); // Exemple: 001
        }

        // Convertir le dernier numéro d'appel en entier
        $nextNumeroAppel = intval($lastNumeroAppel) + 1;

        // Vérifier si le compteur a atteint 999
        if ($nextNumeroAppel > 999) {
            return null; // Tous les numéros ont été utilisés
        }

        // Générer le prochain numéro d'appel
        return str_pad($nextNumeroAppel, 3, '0', STR_PAD_LEFT); // Exemple: 002, 003, ..., 999
    }
}
