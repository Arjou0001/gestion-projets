<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\Projet;
use App\Models\ProjetPossible;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminProjetController extends Controller
{
    /**
     * Affiche la liste de tous les projets.
     */
    public function index()
    {
        $projets = Projet::with('entreprise', 'projetPossible')->paginate(10);
        return view('admin.projets.index', compact('projets'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau projet.
     */
    public function create()
    {
        $entreprises = Entreprise::all();
        $projetsPossibles = []; // Aucun projet possible tant qu’on n’a pas choisi l’entreprise
        return view('admin.projets.create', compact('entreprises', 'projetsPossibles'));
    }

    /**
     * Enregistre un nouveau projet.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'budget' => 'required|numeric|min:1',
            'nombre_personnes' => 'required|integer|min:1',
            'entreprise_id' => 'required|exists:entreprises,id',
            'projet_possible_id' => 'nullable|exists:projet_possibles,id',
            'is_active' => 'nullable|boolean',
        ]);

        // Si la case est cochée, active le projet
        $validated['is_active'] = $request->has('is_active');

        Projet::create($validated);

        return redirect()->route('admin.projets.index')->with('success', 'Le projet a été créé avec succès.');
    }

    /**
     * Affiche les détails d'un projet.
     */
    public function show(Projet $projet)
    {
        return view('admin.projets.show', compact('projet'));
    }

    /**
     * Affiche le formulaire d'édition d'un projet.
     */
   

public function edit(Projet $projet)
{
    $entreprises = Entreprise::all();

    // On récupère les projets possibles selon la nature de l'entreprise liée au projet
    $projetsPossibles = ProjetPossible::where('nature', $projet->entreprise->nature)->get();

    return view('admin.projets.edit', compact('projet', 'entreprises', 'projetsPossibles'));
}


    /**
     * Met à jour un projet existant.
     */
    public function update(Request $request, Projet $projet)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'budget' => 'required|numeric|min:1',
            'nombre_personnes' => 'required|integer|min:1',
            'entreprise_id' => 'required|exists:entreprises,id',
            'projet_possible_id' => 'nullable|exists:projet_possibles,id',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $projet->update($validated);

        return redirect()->route('admin.projets.index')->with('success', 'Le projet a été mis à jour avec succès.');
    }

    /**
     * Active un projet.
     */
    public function activate(Projet $projet): RedirectResponse
    {
        $projet->update(['is_active' => true]);

        return redirect()->route('admin.projets.index')->with('success', 'Le projet a été activé avec succès.');
    }

    /**
     * Désactive un projet.
     */
    public function deactivate(Projet $projet): RedirectResponse
    {
        $projet->update(['is_active' => false]);

        return redirect()->route('admin.projets.index')->with('success', 'Le projet a été désactivé avec succès.');
    }
}
