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
        Schema::table('tiempos_produccions', function (Blueprint $table) {
            $table->unsignedBigInteger('cif_id');
            $table->foreign('cif_id')->references('id')->on('cifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tiempos_produccions', function (Blueprint $table) {
            $table->dropForeign(['cif_id']);
            $table->dropColumn('cif_id');
        });
    }
};
