<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projet_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table projets
            $table->string('nom');
            $table->text('description')->nullable();
            $table->enum('statut', ['À faire', 'En cours', 'Terminé', 'Bloqué'])->default('À faire');
            $table->date('date_debut_prevue')->nullable();
            $table->date('date_fin_prevue')->nullable();
            $table->date('date_debut_reelle')->nullable();
            $table->date('date_fin_reelle')->nullable();
            $table->integer('pourcentage_achevement')->default(0);
            $table->enum('priorite', ['Basse', 'Moyenne', 'Haute'])->default('Moyenne');
            $table->foreignId('tache_parente_id')->nullable()->constrained('tasks')->onDelete('set null'); // Pour les dépendances
            $table->integer('ordre')->nullable(); // Pour l'ordre d'affichage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};