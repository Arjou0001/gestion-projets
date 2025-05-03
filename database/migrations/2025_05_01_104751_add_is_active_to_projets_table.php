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
        $table->boolean('is_active')->default(true); // Par défaut, les projets sont actifs
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('projets', function (Blueprint $table) {
        $table->dropColumn('is_active');
    });
}
};
