<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjetPossible;

class ProjetsPossiblesSeeder extends Seeder
{
    public function run()
    {
        $projets = [
            [
                'intitule' => 'Application web de gestion de stock',
                'nature' => 'Informatique',
                'description' => 'Une plateforme pour gérer les entrées et sorties de produits.',
                'maquette_taches' => ['Conception de la base de données', 'Développement de l\'interface utilisateur', 'Implémentation des fonctionnalités de gestion des stocks', 'Tests fonctionnels', 'Déploiement'],
            ],
            [
                'intitule' => 'Site vitrine d\'entreprise',
                'nature' => 'Informatique',
                'description' => 'Un site simple pour présenter les services d’une entreprise.',
                'maquette_taches' => ['Définition du contenu', 'Conception graphique', 'Développement des pages', 'Optimisation SEO de base', 'Mise en ligne'],
            ],
            [
                'intitule' => 'Système de facturation en ligne',
                'nature' => 'Informatique',
                'description' => 'Application SaaS pour générer et envoyer des factures.',
                'maquette_taches' => ['Analyse des besoins fonctionnels', 'Conception de la base de données', 'Développement des modules de facturation', 'Intégration des paiements', 'Tests et déploiement'],
            ],
            [
                'intitule' => 'Construction d’un immeuble résidentiel',
                'nature' => 'BTP',
                'description' => 'Projet de construction d’un immeuble de 3 étages.',
                'maquette_taches' => ['Obtention des permis de construire', 'Préparation et nivellement du terrain', 'Excavation et fondations', 'Construction de la structure (murs, planchers)', 'Installation de la toiture', 'Travaux de second œuvre (électricité, plomberie, isolation)', 'Finitions intérieures et extérieures'],
            ],
            [
                'intitule' => 'Rénovation de locaux commerciaux',
                'nature' => 'BTP',
                'description' => 'Remise à neuf d’un espace commercial en centre-ville.',
                'maquette_taches' => ['Démolition des aménagements existants', 'Travaux de maçonnerie et de plâtrerie', 'Installation électrique et de plomberie', 'Revêtements de sol et muraux', 'Peinture et finitions', 'Installation du mobilier et des équipements'],
            ],
            [
                'intitule' => 'Création d’un entrepôt logistique',
                'nature' => 'BTP',
                'description' => 'Construction d’un entrepôt pour stockage de marchandises.',
                'maquette_taches' => ['Étude de faisabilité et conception', 'Obtention des autorisations', 'Terrassement et fondations', 'Montage de la structure métallique', 'Pose de la toiture et du bardage', 'Aménagements intérieurs (rayonnages, zones de chargement)', 'Aménagements extérieurs (accès, parking)'],
            ],
            [
                'intitule' => 'Lancement d’une boutique en ligne',
                'nature' => 'Commerce',
                'description' => 'E-commerce spécialisé dans les produits artisanaux.',
                'maquette_taches' => ['Choix de la plateforme e-commerce', 'Conception du design de la boutique', 'Intégration des produits et des descriptions', 'Configuration des modes de paiement et de livraison', 'Mise en place du marketing initial', 'Tests et lancement'],
            ],
            [
                'intitule' => 'Ouverture d’une supérette de quartier',
                'nature' => 'Commerce',
                'description' => 'Commerce de proximité pour la vente de produits alimentaires.',
                'maquette_taches' => ['Recherche et aménagement du local', 'Obtention des licences et permis', 'Sélection des fournisseurs et commandes initiales', 'Installation du mobilier et des équipements', 'Recrutement et formation du personnel', 'Campagne de communication de lancement'],
            ],
            [
                'intitule' => 'Franchise de vêtements',
                'nature' => 'Commerce',
                'description' => 'Vente de vêtements via un modèle de franchise.',
                'maquette_taches' => ['Sélection de la franchise', 'Recherche et aménagement du local', 'Formation initiale du franchisé', 'Réception du stock initial', 'Mise en place de la stratégie marketing locale', 'Ouverture de la boutique'],
            ],
            [
                'intitule' => 'Exploitation d’une ferme de production maraîchère',
                'nature' => 'Agriculture',
                'description' => 'Culture intensive de légumes pour la vente locale.',
                'maquette_taches' => ['Préparation des sols', 'Achat des semences et plants', 'Plantation', 'Entretien des cultures (irrigation, fertilisation, protection)', 'Récolte', 'Conditionnement et commercialisation'],
            ],
            [
                'intitule' => 'Élevage de volailles',
                'nature' => 'Agriculture',
                'description' => 'Production de volailles pour la consommation.',
                'maquette_taches' => ['Construction ou aménagement des bâtiments d\'élevage', 'Achat des poussins', 'Alimentation et soins', 'Suivi sanitaire', 'Abattage et transformation', 'Commercialisation'],
            ],
            [
                'intitule' => 'Projet de permaculture urbaine',
                'nature' => 'Agriculture',
                'description' => 'Production alimentaire durable en ville.',
                'maquette_taches' => ['Conception du système de permaculture', 'Préparation du site (création de buttes, installation de composteurs)', 'Plantation des premières cultures', 'Mise en place de systèmes de récupération d\'eau', 'Suivi et ajustements', 'Récolte et distribution'],
            ],
            [
                'intitule' => 'Ouverture d’une clinique privée',
                'nature' => 'Santé',
                'description' => 'Centre de soins pluridisciplinaire.',
                'maquette_taches' => ['Recherche et aménagement des locaux', 'Obtention des agréments et licences', 'Achat du matériel médical', 'Recrutement du personnel médical et administratif', 'Mise en place des protocoles de soins', 'Campagne de communication de lancement'],
            ],
            [
                'intitule' => 'Application de suivi de santé',
                'nature' => 'Santé',
                'description' => 'Application mobile pour le suivi de la santé des patients.',
                'maquette_taches' => ['Définition des fonctionnalités', 'Conception de l\'interface utilisateur (UI/UX)', 'Développement de l\'application (front-end et back-end)', 'Tests et assurance qualité', 'Déploiement sur les stores', 'Maintenance et mises à jour'],
            ],
            [
                'intitule' => 'Service de téléconsultation',
                'nature' => 'Santé',
                'description' => 'Plateforme en ligne pour les consultations médicales à distance.',
                'maquette_taches' => ['Définition des fonctionnalités de la plateforme', 'Développement de l\'interface web et mobile', 'Intégration des outils de communication sécurisée', 'Gestion des plannings et des rendez-vous', 'Tests de sécurité et de conformité', 'Lancement et support utilisateur'],
            ],
        ];

        foreach ($projets as $projet) {
            ProjetPossible::create([
                'intitule' => $projet['intitule'],
                'nature' => $projet['nature'],
                'description' => $projet['description'],
                'maquette_taches' => json_encode($projet['maquette_taches']),
            ]);
        }
    }
}
