<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projet_possibles', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->string('nature');
            $table->text('description')->nullable();
            $table->json('maquette_taches')->nullable(); // <<< DIRECTEMENT en JSON ici
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projet_possibles');
    }
};