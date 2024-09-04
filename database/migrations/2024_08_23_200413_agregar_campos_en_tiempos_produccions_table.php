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
        Schema::table('costos_produccions', function (Blueprint $table) {
            $table->unsignedBigInteger('tiempo_produccion_id');
            $table->unsignedBigInteger('cif_id');

            $table->foreign('tiempo_produccion_id')->references('id')->on('tiempos_produccions')->onDelete('cascade');
            $table->foreign('cif_id')->references('id')->on('cifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('costos_produccions', function (Blueprint $table) {
            $table->dropForeign('costos_produccions_tiempos_produccions');
            $table->dropForeign('costos_produccions_cifs');
            $table->dropColumn(['tiempo_produccion_id', 'cif_id']);
        });
    }
};
