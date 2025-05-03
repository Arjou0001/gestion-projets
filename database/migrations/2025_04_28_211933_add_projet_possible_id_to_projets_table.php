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
        Schema::table('projets', function (Blueprint $table) {
            $table->foreignId('projet_possible_id')->nullable()->constrained('projet_possibles')->onDelete('set null');
            $table->index('projet_possible_id'); // Facultatif, mais recommandé
        });
    }

    public function down(): void
    {
        Schema::table('projets', function (Blueprint $table) {
            $table->dropForeign(['projet_possible_id']);
            $table->dropColumn('projet_possible_id');
        });
    }
};
