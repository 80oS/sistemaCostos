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
        Schema::table('servicios_costos', function (Blueprint $table) {
            $table->unsignedBigInteger('tiempo_produccion_id');

            $table->foreign('tiempo_produccion_id')->references('id')->on('tiempos_produccions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios_costos', function (Blueprint $table) {
            $table->dropForeign('servicios_costos_tiempo_produccion_id_foreign');
            $table->dropColumn('tiempo_produccion_id');
        });
    }
};
