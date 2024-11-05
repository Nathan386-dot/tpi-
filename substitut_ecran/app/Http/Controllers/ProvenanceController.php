<?php

namespace App\Http\Controllers;

use App\Models\Provenance;
use Illuminate\Http\Request;

class ProvenanceController extends Controller
{
    // Méthode pour afficher la liste des provenances
    public function index()
    {
        $provenances = Provenance::all();
        return view('provenances.index', compact('provenances'));
    }

    // Méthode pour afficher le formulaire d'ajout de provenance
    public function create()
    {
        return view('provenances.create'); // Retourne la vue de création de provenance
    }

    // Méthode pour enregistrer une nouvelle provenance
    public function store(Request $request)
    {
        $request->validate([
            'provenance_name' => 'required|string|max:255',
        ]);

        Provenance::create($request->all());
        return redirect()->route('provenances.index')->with('success', 'Provenance ajoutée avec succès.');
    }

    // Méthode pour afficher le formulaire d'édition d'une provenance
    public function edit($id)
    {
        $provenance = Provenance::findOrFail($id);
        return view('provenances.edit', compact('provenance'));
    }

    // Méthode pour mettre à jour une provenance
    public function update(Request $request, $id)
    {
        $request->validate([
            'provenance_name' => 'required|string|max:255',
        ]);

        $provenance = Provenance::findOrFail($id);
        $provenance->update($request->all());

        return redirect()->route('provenances.index')->with('success', 'Provenance mise à jour avec succès.');
    }

    // Méthode pour supprimer une provenance
    public function destroy($id)
    {
        $provenance = Provenance::find($id);

        if ($provenance) {
            $provenance->delete();
            return redirect()->route('provenances.index')->with('success', 'Provenance supprimée avec succès.');
        } else {
            return redirect()->route('provenances.index')->with('error', 'Provenance non trouvée.');
        }
    }
}
