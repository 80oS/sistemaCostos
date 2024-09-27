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
        Schema::table('articulo_tiempos_produccion', function (Blueprint $table) {
            $table->decimal('utilidad_bruta', 20, 2);
            $table->decimal('margen_bruto', 20, 2);
            $table->unsignedBigInteger('costos_produccion_id');
            $table->foreign('costos_produccion_id')->references('id')->on('costos_produccions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('costos_produccions', function (Blueprint $table) {
            $table->dropForeign('costos_produccions_id_foreign');
            $table->dropColumn(['costos_produccion_id', 'utilidad_bruta', 'margen_bruto']);
        });
    }
};
