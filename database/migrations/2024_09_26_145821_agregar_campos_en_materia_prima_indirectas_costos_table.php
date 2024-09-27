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
        Schema::table('materia_prima_indirectas_costos', function (Blueprint $table) {
            $table->unsignedBigInteger('articulo_id');
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materia_prima_indirectas_costos', function (Blueprint $table) {
            $table->dropForeign('materia_prima_directas_costos_articulo_id_foreign');
            $table->dropColumn('articulo_id');
        });
    }
};
