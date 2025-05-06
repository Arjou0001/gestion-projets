<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Projet;
use App\Models\User; // Importe le modèle User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    /**
     * Affiche le tableau de bord de l'utilisateur connecté.
     */
    public function index()
    {
        $user = Auth::user();
        $entreprises = $user->entreprises()->paginate(10);
        $totalEntreprisesActives = $user->entreprises()->where('is_active', true)->count();
        $totalEntreprises = $user->entreprises()->count(); // Récupère le nombre total d'entreprises de l'utilisateur
        $totalProjets = Projet::whereHas('entreprise', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // Récupère la liste des utilisateurs (pour l'administrateur - nécessite une vérification du rôle)
        $users = User::paginate(5); // Pagination des utilisateurs
        $totalUsers = User::count();

        return view('dashboard', compact('entreprises', 'totalEntreprisesActives', 'totalEntreprises', 'totalProjets', 'users', 'totalUsers'));
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


       public function destroy(Entreprise $entreprise)
    {
        // Optionnel : vérifier que l'utilisateur est bien le propriétaire
        if ($entreprise->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        $entreprise->delete();

        return redirect()->route('dashboard')->with('success', 'Entreprise supprimée avec succès.');
    }

}