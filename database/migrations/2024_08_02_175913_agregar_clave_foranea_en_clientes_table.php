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
        Schema::table('clientes', function (Blueprint $table) {
            // Agregar la columna si no existe
            if (!Schema::hasColumn('clientes', 'comerciales_id')) {
                $table->unsignedBigInteger('comerciales_id');
            }

            // Agregar la clave foránea
            $table->foreign('comerciales_id')->references('id')->on('vendedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['comerciales_id']);

            // Eliminar la columna
            $table->dropColumn('comerciales_id');
        });
    }
};