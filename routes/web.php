<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminChefEntrepriseController;
use App\Http\Controllers\Admin\AdminEntrepriseController;
use App\Http\Controllers\Admin\AdminProjetController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetController;
use Illuminate\Support\Facades\Route;
use App\Models\Entreprise;
use App\Models\ProjetPossible;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard du chef d'entreprise : affiche les entreprises actives
Route::get('/dashboard', [EntrepriseController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Routes pour utilisateurs authentifiés (chefs d'entreprise)
Route::middleware('auth')->group(function () {
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Projets (côté chef d'entreprise)
    Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
    Route::get('/projets/create', [ProjetController::class, 'create'])->name('projets.create');
    Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
    Route::get('/projets/exemples/{nature}', [ProjetController::class, 'getExemplesParNature'])->name('projets.exemples_par_nature');
    Route::get('/projets/{projet}', [ProjetController::class, 'show'])->name('projets.show');
    Route::get('/projets/{projet}/edit', [ProjetController::class, 'edit'])->name('projets.edit');
    Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projets.update');
    Route::delete('/projets/{projet}', [ProjetController::class, 'destroy'])->name('projets.destroy');
    Route::post('/projets/{projet}/activate', [ProjetController::class, 'activate'])->name('projets.activate');
    Route::post('/projets/{projet}/deactivate', [ProjetController::class, 'deactivate'])->name('projets.deactivate');

    // Entreprises (côté chef d'entreprise)
    Route::resource('entreprises', EntrepriseController::class)->except(['destroy']);
    Route::get('/entreprises/{entreprise}/activate', [EntrepriseController::class, 'activate'])->name('entreprises.activate');
    // Suppression d'une entreprise (formulaire ou lien direct)
    Route::delete('/entreprises/{entreprise}', [EntrepriseController::class, 'destroy'])->name('entreprises.destroy');

});

// Routes Admin (protégées par 'isAdmin' middleware)
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Gestion des utilisateurs (chefs d'entreprise)
    Route::resource('users', AdminChefEntrepriseController::class);
    Route::get('users/{user}/confirm-delete', [AdminChefEntrepriseController::class, 'confirmDelete'])->name('users.confirm-delete');
    Route::delete('users/{user}/delete', [AdminChefEntrepriseController::class, 'destroy'])->name('users.delete');

    // Gestion des entreprises (admin)
    Route::resource('entreprises', AdminEntrepriseController::class)->except(['destroy']);
    Route::get('entreprises/create/{chef_id?}', [AdminEntrepriseController::class, 'create'])->name('entreprises.create');
    Route::get('entreprises/{entreprise}/edit', [AdminEntrepriseController::class, 'edit'])->name('entreprises.edit');
    Route::put('entreprises/{entreprise}', [AdminEntrepriseController::class, 'update'])->name('entreprises.update');
    Route::get('entreprises/{entreprise}/deactivate', [AdminEntrepriseController::class, 'deactivate'])->name('entreprises.deactivate');
    Route::get('entreprises/{entreprise}/activate', [AdminEntrepriseController::class, 'activate'])->name('entreprises.activate');

    // Gestion des projets (admin)
    Route::resource('projets', AdminProjetController::class)->except(['destroy']);
    Route::get('projets/{projet}/activate', [AdminProjetController::class, 'activate'])->name('projets.activate');
    Route::get('projets/{projet}/deactivate', [AdminProjetController::class, 'deactivate'])->name('projets.deactivate');

    // Récupération des projets possibles selon la nature d’une entreprise
    Route::get('/projets-possibles/{entreprise_id}', function ($entreprise_id) {
        $entreprise = Entreprise::findOrFail($entreprise_id);
        $projets = ProjetPossible::where('nature', $entreprise->nature)->get();
        return response()->json($projets);
    })->name('projets.possibles');

    // Déconnexion admin
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

require __DIR__.'/auth.php';
