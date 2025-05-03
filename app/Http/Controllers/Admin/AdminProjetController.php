<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\Projet;
use App\Models\ProjetPossible;
use Illuminate\Http\Request;

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
     * Affiche le formulaire de création d'un nouveau projet (pour l'admin).
     */
    public function create()
    {
        $entreprises = Entreprise::all();
        $projetsPossibles = ProjetPossible::all();
        return view('admin.projets.create', compact('entreprises', 'projetsPossibles'));
    }

    /**
     * Enregistre un nouveau projet.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'budget' => 'required|numeric|min:1',
            'nombre_personnes' => 'required|integer|min:1',
            'entreprise_id' => 'required|exists:entreprises,id',
            'projet_possible_id' => 'nullable|exists:projet_possibles,id',
            'is_active' => 'nullable|boolean',
        ]);

        Projet::create($request->all());

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
        $projetsPossibles = ProjetPossible::all();
        return view('admin.projets.edit', compact('projet', 'entreprises', 'projetsPossibles'));
    }

    /**
     * Met à jour un projet.
     */
    public function update(Request $request, Projet $projet)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'budget' => 'required|numeric|min:1',
            'nombre_personnes' => 'required|integer|min:1',
            'entreprise_id' => 'required|exists:entreprises,id',
            'projet_possible_id' => 'nullable|exists:projet_possibles,id',
            'is_active' => 'nullable|boolean',
        ]);

        $projet->update($request->all());

        return redirect()->route('admin.projets.index')->with('success', 'Le projet a été mis à jour avec succès.');
    }

    /**
     * Désactive un projet.
     */
    public function deactivate(Projet $projet)
    {
        $projet->update(['is_active' => false]);
        return redirect()->route('admin.projets.index')->with('success', 'Le projet "' . $projet->nom . '" a été désactivé.');
    }

    /**
     * Active un projet.
     */
    public function activate(Projet $projet)
    {
        $projet->update(['is_active' => true]);
        return redirect()->route('admin.projets.index')->with('success', 'Le projet "' . $projet->nom . '" a été activé.');
    }
}