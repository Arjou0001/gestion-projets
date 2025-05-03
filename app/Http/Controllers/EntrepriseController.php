<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    /**
     * Affiche la liste des entreprises actives de l'utilisateur connecté.
     */
    public function index()
    {
        $entreprises = Entreprise::where('user_id', Auth::id())
            ->where('is_active', true)
            ->paginate(10);
        return view('dashboard', compact('entreprises'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle entreprise.
     */
    public function create()
    {
        return view('entreprises.create');
    }

    /**
     * Enregistre une nouvelle entreprise pour l'utilisateur connecté.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'nature' => 'required|string|max:255',
            'ifu' => ['required', 'regex:/^[0-9]{11,13}$/'],
        ]);

        Entreprise::create([
            'nom' => $request->nom,
            'nature' => $request->nature,
            'ifu' => $request->ifu,
            'user_id' => Auth::id(),
            'is_active' => true, // Par défaut, la nouvelle entreprise est active
        ]);

        return redirect()->route('entreprises.index')->with('success', 'Entreprise créée avec succès.');
    }

    /**
     * Affiche le formulaire d'édition de l'entreprise.
     */
    public function edit(Entreprise $entreprise)
    {
        if ($entreprise->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
        return view('entreprises.edit', compact('entreprise'));
    }

    /**
     * Met à jour les informations de l'entreprise.
     */
    public function update(Request $request, Entreprise $entreprise)
    {
        if ($entreprise->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
        $request->validate([
            'nom' => 'required|string|max:255',
            'nature' => 'required|string|max:255',
            'ifu' => ['required', 'regex:/^[0-9]{11,13}$/'],
        ]);

        $entreprise->update($request->all());
        return redirect()->route('entreprises.index')->with('success', 'Entreprise mise à jour avec succès.');
    }

    /**
     * Réactive une entreprise.
     */
    public function activate(Entreprise $entreprise)
    {
        if ($entreprise->user_id === Auth::id()) {
            $entreprise->update(['is_active' => true]);
            return redirect()->route('entreprises.index')->with('success', 'L\'entreprise ' . $entreprise->nom . ' a été réactivée.');
        } else {
            abort(403, 'Accès non autorisé.');
        }
    }
}