<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;

class AdminEntrepriseController extends Controller
{
    /**
     * Affiche la liste des entreprises.
     */
    public function index()
    {
        $entreprises = Entreprise::with('user')->paginate(10);
        return view('admin.entreprises.index', compact('entreprises'));
    }

    /**
     * Affiche le formulaire de création d'une entreprise.
     */
    public function create(Request $request, $chef_id = null)
{
    $chefsEntreprise = User::where('role', 'entreprise')->get();
    $selectedChefId = $chef_id;
    return view('admin.entreprises.create', compact('chefsEntreprise', 'selectedChefId'));
}

    /**
     * Enregistre une nouvelle entreprise.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:entreprises,nom'],
            'nature' => ['required', 'string', 'max:255'],
            'ifu' => ['required', 'regex:/^[0-9]{11,13}$/', 'unique:entreprises,ifu'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        Entreprise::create($validated);

        return redirect()->route('admin.entreprises.index')->with('success', 'L\'entreprise a été ajoutée avec succès.');
    }

    /**
     * Affiche les détails d'une entreprise.
     */
    public function show(Entreprise $entreprise)
    {
        return view('admin.entreprises.show', compact('entreprise'));
    }

    /**
     * Affiche le formulaire d'édition d'une entreprise.
     */
    public function edit(Entreprise $entreprise)
    {
        $users = User::all();
        return view('admin.entreprises.edit', compact('entreprise', 'users'));
    }

    /**
     * Met à jour une entreprise.
     */
    public function update(Request $request, Entreprise $entreprise)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:entreprises,nom,' . $entreprise->id],
            'nature' => ['required', 'string', 'max:255'],
            'ifu' => ['required', 'regex:/^[0-9]{11,13}$/', 'unique:entreprises,ifu,' . $entreprise->id],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $entreprise->update($validated);

        return redirect()->route('admin.entreprises.index')->with('success', 'L\'entreprise a été mise à jour avec succès.');
    }

    /**
     * Désactive une entreprise.
     */
    public function deactivate(Entreprise $entreprise)
    {
        $entreprise->update(['is_active' => false]);
        return redirect()->route('admin.entreprises.index')->with('success', 'L\'entreprise ' . $entreprise->nom . ' a été désactivée.');
    }

    /**
     * Active une entreprise.
     */
    public function activate(Entreprise $entreprise)
    {
        $entreprise->update(['is_active' => true]);
        return redirect()->route('admin.entreprises.index')->with('success', 'L\'entreprise ' . $entreprise->nom . ' a été activée.');
    }
}