<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubstitutController;
use App\Http\Controllers\ProvenanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController; 
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
require __DIR__.'/auth.php';

// Routes protégées par l'authentification
Route::middleware(['auth', 'verified'])->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    // Route pour afficher la liste des utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Routes pour la gestion des utilisateurs
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); 
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);

    // Routes pour la gestion du profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour le substitut
    Route::get('/substitut', [SubstitutController::class, 'index'])->name('substitut.index');
    Route::post('/substitut/take-charge', [SubstitutController::class, 'takeCharge'])->name('substitut.take_charge');
    Route::get('/substitut/liberate', [SubstitutController::class, 'liberate'])->name('substitut.liberate');
    Route::delete('/substitut/release/{id}', [SubstitutController::class, 'release'])->name('substitut.release');
    
    // Route pour afficher la liste des OPJ
    Route::get('/substitut/get-opjs', [SubstitutController::class, 'getOpjs'])->name('substitut.get_opjs');

    Route::get('/substitut/file-d-attente', [SubstitutController::class, 'showQueue'])->name('substitut.file_d_attente');
    Route::delete('/file_d_attente/{id}', [SubstitutController::class, 'destroy'])->name('substitut.file_d_attente.destroy');

    // Routes pour le profil des substituts
    Route::get('/substitut/profil', [SubstitutController::class, 'edit'])->name('substitut.profil');
    Route::post('/substitut/profil/update', [SubstitutController::class, 'update'])->name('substitut.profil.update');

    // Routes pour la provenance
    Route::get('/provenances', [ProvenanceController::class, 'index'])->name('provenances.index');
    Route::post('/provenances', [ProvenanceController::class, 'store'])->name('provenances.store');
    Route::get('/provenances/create', [ProvenanceController::class, 'create'])->name('provenances.create');
    
    // Routes d'édition pour la provenance
    Route::get('/provenances/{id}/edit', [ProvenanceController::class, 'edit'])->name('provenances.edit'); // Route pour afficher le formulaire d'édition
    Route::patch('/provenances/{id}', [ProvenanceController::class, 'update'])->name('provenances.update'); // Route pour mettre à jour la provenance
    Route::delete('/provenances/{id}', [ProvenanceController::class, 'destroy'])->name('provenances.destroy');

    // Déconnexion
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
