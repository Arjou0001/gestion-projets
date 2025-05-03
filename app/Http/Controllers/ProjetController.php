<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Entreprise;
use App\Models\ProjetPossible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetController extends Controller
{
    /**
     * Affiche la liste des projets du chef d'entreprise.
     */
    public function index()
    {
        $projets = Projet::whereHas('entreprise', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('entreprise', 'projetPossible')
            ->paginate(10);

        return view('projets.index', compact('projets'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau projet.
     */
    public function create()
    {
        $entreprises = Entreprise::where('user_id', Auth::id())->get();
        $projetsPossibles = ProjetPossible::all();

        if ($entreprises->isEmpty()) {
            return redirect()->route('entreprises.create')->with('warning', 'Veuillez créer une entreprise avant de créer un projet.');
        }

        return view('projets.create', compact('entreprises', 'projetsPossibles'));
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
            'exemple_projet_id' => 'nullable|exists:projet_possibles,id',
        ]);

        $entreprise = Entreprise::where('id', $request->entreprise_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $projet = Projet::create([
            'nom' => $request->nom,
            'duree' => $request->duree,
            'budget' => $request->budget,
            'nombre_personnes' => $request->nombre_personnes,
            'entreprise_id' => $entreprise->id,
            'projet_possible_id' => $request->exemple_projet_id,
        ]);

        return redirect()->route('projets.show', $projet->id)->with('success', 'Projet créé avec succès !');
    }

    /**
     * Récupère les exemples de projets par nature.
     */
    public function getExemplesParNature(string $nature)
    {
        $exemples = ProjetPossible::where('nature', $nature)->get();
        return response()->json($exemples);
    }

    /**
     * Affiche les détails d'un projet.
     */
    public function show(Projet $projet)
    {
        // Vérifier si le projet appartient à l'entreprise de l'utilisateur
        if ($projet->entreprise->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $projetPossible = $projet->projetPossible;
        $taches = $projetPossible ? json_decode($projetPossible->maquette_taches, true) : [];
        $dataPourCharts = $this->genererDonneesCharts($projet);
        $dataPourResumes = $this->genererDonneesResumes($projet);

        return view('projets.show', compact('projet', 'dataPourCharts', 'dataPourResumes', 'taches'));
    }

    /**
     * Génère des données pour les graphiques (méthode privée).
     */
    private function genererDonneesCharts(Projet $projet)
    {
        $nature = $projet->entreprise->nature;

        switch ($nature) {
            case 'Informatique':
                return [
                    'type' => 'bar',
                    'labels' => ['Développement', 'Tests', 'Déploiement'],
                    'datasets' => [
                        ['label' => 'Heures estimées', 'data' => [rand(50, 100), rand(30, 70), rand(20, 50)]],
                        ['label' => 'Budget estimé', 'data' => [rand(5000, 10000), rand(2000, 5000), rand(1000, 3000)]],
                    ],
                ];
            case 'BTP':
                return [
                    'type' => 'pie',
                    'labels' => ['Matériaux', 'Main d\'œuvre', 'Sous-traitance'],
                    'datasets' => [['data' => [rand(30, 50), rand(20, 40), rand(10, 30)]]],
                ];
            case 'Commerce':
                return [
                    'type' => 'line',
                    'labels' => ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'],
                    'datasets' => [['label' => 'Ventes prévues', 'data' => [rand(100, 200), rand(150, 250), rand(200, 300), rand(250, 350)]]],
                ];
            case 'Agriculture':
                return [
                    'type' => 'doughnut',
                    'labels' => ['Semences', 'Fertilisants', 'Récolte'],
                    'datasets' => [['data' => [rand(20, 40), rand(30, 50), rand(10, 30)]]],
                ];
            case 'Santé':
                return [
                    'type' => 'radar',
                    'labels' => ['Consultations', 'Analyses', 'Soins'],
                    'datasets' => [['label' => 'Nombre de patients', 'data' => [rand(10, 30), rand(15, 40), rand(20, 50)]]],
                ];
            default:
                return [];
        }
    }

    /**
     * Génère des données pour les résumés (méthode privée).
     */
    private function genererDonneesResumes(Projet $projet)
    {
        $nature = $projet->entreprise->nature;

        switch ($nature) {
            case 'Informatique':
                return [
                    'duree_estimee' => $projet->duree . ' jours',
                    'budget_total' => $projet->budget . ' €',
                    'personnes_requises' => $projet->nombre_personnes,
                ];
            case 'BTP':
                return [
                    'surface_totale' => rand(100, 1000) . ' m²',
                    'materiaux_principaux' => ['Ciment', 'Acier', 'Briques'],
                    'delai_prevu' => $projet->duree . ' jours',
                ];
            case 'Commerce':
                return [
                    'objectif_vente' => rand(1000, 10000) . ' €/mois',
                    'marge_moyenne' => rand(15, 30) . '%',
                    'investissements_initiaux' => $projet->budget . ' €',
                ];
            case 'Agriculture':
                return [
                    'type_culture' => 'Variable',
                    'surface_cultivee' => rand(1, 10) . ' hectares',
                    'periode_plantation' => 'Saisonnière',
                ];
            case 'Santé':
                return [
                    'nombre_lits' => rand(10, 50),
                    'specialites_offertes' => ['Générale', 'Spécialisée'],
                    'taux_occupation_moyen' => rand(60, 90) . '%',
                ];
            default:
                return [];
        }
    }

    /**
     * Affiche le formulaire d'édition d'un projet.
     */
    public function edit(Projet $projet)
    {
        // Vérifier si le projet appartient à l'entreprise de l'utilisateur
        if ($projet->entreprise->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $entreprises = Entreprise::where('user_id', Auth::id())->get();
        return view('projets.edit', compact('projet', 'entreprises'));
    }

    /**
     * Met à jour un projet.
     */
    public function update(Request $request, Projet $projet)
    {
        // Vérifier si le projet appartient à l'entreprise de l'utilisateur
        if ($projet->entreprise->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'duree' => 'required|integer|min:1',
            'budget' => 'required|numeric|min:1',
            'nombre_personnes' => 'required|integer|min:1',
            'entreprise_id' => 'required|exists:entreprises,id',
        ]);

        $projet->update([
            'nom' => $request->nom,
            'duree' => $request->duree,
            'budget' => $request->budget,
            'nombre_personnes' => $request->nombre_personnes,
            'entreprise_id' => $request->entreprise_id,
        ]);

        return redirect()->route('projets.index')->with('success', 'Projet mis à jour avec succès !');
    }

    /**
     * Supprime un projet.
     */
    public function destroy(Projet $projet)
    {
        // Vérifier si le projet appartient à l'entreprise de l'utilisateur
        if ($projet->entreprise->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $projet->delete();
        return redirect()->route('projets.index')->with('success', 'Projet supprimé avec succès !');
    }

    /**
     * Active un projet désactivé.
     */
    public function activate(Projet $projet)
    {
        // Vérifier si le projet appartient à l'entreprise de l'utilisateur
        if ($projet->entreprise->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $projet->update(['is_active' => true]);
        return redirect()->route('projets.index')->with('success', 'Le projet "' . $projet->nom . '" a été activé.');
    }

    /**
     * Désactive un projet actif.
     */
    public function deactivate(Projet $projet)
    {
        // Vérifier si le projet appartient à l'entreprise de l'utilisateur
        if ($projet->entreprise->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $projet->update(['is_active' => false]);
        return redirect()->route('projets.index')->with('success', 'Le projet "' . $projet->nom . '" a été désactivé.');
    }
}