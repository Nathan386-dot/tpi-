<?php 

use App\Http\Controllers\AffichageController;

// Route pour afficher la liste d'attente
Route::get('/affichage', [AffichageController::class, 'index'])->name('affichage.index');
