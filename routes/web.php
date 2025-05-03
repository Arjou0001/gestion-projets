<?php

use App\Http\Controllers\Admin\AdminChefEntrepriseController;
use App\Http\Controllers\Admin\AdminEntrepriseController;
use App\Http\Controllers\Admin\AdminProjetController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\TaskController; // Assurez-vous d'importer le TaskController
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Modifier la route du dashboard pour utiliser EntrepriseController et afficher les entreprises actives
Route::get('/dashboard', [EntrepriseController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées par auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour la gestion des projets (chef d'entreprise)
    Route::get('/projets/create', [ProjetController::class, 'create'])->name('projets.create');
    Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
    Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
    Route::get('/projets/exemples/{nature}', [ProjetController::class, 'getExemplesParNature'])->name('projets.exemples_par_nature');
    Route::get('/projets/{projet}', [ProjetController::class, 'show'])->name('projets.show');
    Route::get('/projets/{projet}/edit', [ProjetController::class, 'edit'])->name('projets.edit');
    Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projets.update');
    Route::delete('/projets/{projet}', [ProjetController::class, 'destroy'])->name('projets.destroy');

    // Ajout des routes pour activer et désactiver les projets par le chef d'entreprise
    Route::post('/projets/{projet}/activate', [ProjetController::class, 'activate'])->name('projets.activate');
    Route::post('/projets/{projet}/deactivate', [ProjetController::class, 'deactivate'])->name('projets.deactivate');

    // Routes pour la gestion des entreprises (pour le chef d'entreprise)
    Route::resource('entreprises', EntrepriseController::class)->except(['destroy', 'create', 'store', 'show', 'edit', 'update']);
    Route::get('/entreprises/create', [EntrepriseController::class, 'create'])->name('entreprises.create');
    Route::post('/entreprises', [EntrepriseController::class, 'store'])->name('entreprises.store');
    Route::get('/entreprises/{entreprise}', [EntrepriseController::class, 'show'])->name('entreprises.show');
    Route::get('/entreprises/{entreprise}/edit', [EntrepriseController::class, 'edit'])->name('entreprises.edit');
    Route::put('/entreprises/{entreprise}', [EntrepriseController::class, 'update'])->name('entreprises.update');
    Route::get('/entreprises/{entreprise}/activate', [EntrepriseController::class, 'activate'])->name('entreprises.activate');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    // Route pour le tableau de bord de l'administrateur
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Assurez-vous que cette vue existe
    })->name('dashboard');

    // Routes pour la gestion des chefs d'entreprise
    Route::resource('users', AdminChefEntrepriseController::class);
    Route::get('users/{user}/confirm-delete', [AdminChefEntrepriseController::class, 'confirmDelete'])->name('users.confirm-delete');
    Route::delete('users/{user}/delete', [AdminChefEntrepriseController::class, 'destroy'])->name('users.delete');

    // Routes pour la gestion des entreprises (pour l'administrateur)
    Route::resource('entreprises', AdminEntrepriseController::class)->except(['destroy', 'create', 'edit', 'update']);
    Route::get('entreprises/create/{chef_id?}', [AdminEntrepriseController::class, 'create'])->name('entreprises.create');
    Route::get('entreprises/{entreprise}/edit', [AdminEntrepriseController::class, 'edit'])->name('entreprises.edit');
    Route::put('entreprises/{entreprise}', [AdminEntrepriseController::class, 'update'])->name('entreprises.update');
    Route::get('entreprises/{entreprise}/deactivate', [AdminEntrepriseController::class, 'deactivate'])->name('entreprises.deactivate');
    Route::get('entreprises/{entreprise}/activate', [AdminEntrepriseController::class, 'activate'])->name('entreprises.activate');

    // Routes pour la gestion des projets (pour l'administrateur)
    Route::resource('projets', AdminProjetController::class)->except(['destroy']);
    Route::get('projets/{projet}/deactivate', [AdminProjetController::class, 'deactivate'])->name('admin.projets.deactivate');
    Route::get('projets/{projet}/activate', [AdminProjetController::class, 'activate'])->name('admin.projets.activate');
});

require __DIR__.'/auth.php';