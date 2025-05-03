<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('entreprises', function (Blueprint $table) {
        $table->boolean('deletion_requested')->default(false);
    });
}

public function down()
{
    Schema::table('entreprises', function (Blueprint $table) {
        $table->dropColumn('deletion_requested');
    });
}
};
