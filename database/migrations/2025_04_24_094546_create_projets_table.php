<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('projets', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->integer('duree')->unsigned(); // en jours ou mois ?
        $table->decimal('budget', 15, 2)->unsigned();
        $table->integer('nombre_personnes')->unsigned();
        $table->foreignId('entreprise_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

};
