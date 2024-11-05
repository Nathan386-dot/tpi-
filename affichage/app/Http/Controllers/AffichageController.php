<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileDAttente;

class AffichageController extends Controller
{
    // Méthode pour afficher la page avec la file d'attente
    public function index()
    {
        // Récupérer les entrées de la file d'attente avec le numéro d'appel et le numéro de porte
        $file_d_attente = FileDAttente::with('user') // Charger la relation user
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get()
            ->map(function ($item) {
                return [
                    'numero_appel' => $item->numero_appel, // Champ existant dans FileDAttente
                    'door_number' => $item->door_number, // Utiliser le door_number directement
                ];
            });

        // Passer les données à la vue
        return view('affichage.index', compact('file_d_attente'));
    }

}
