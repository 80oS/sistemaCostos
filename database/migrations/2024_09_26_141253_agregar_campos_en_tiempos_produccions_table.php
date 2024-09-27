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
            if (Schema::hasColumn('tiempos_produccions', 'articulo_id')) {
                // Si la columna existe, primero eliminamos la relación de clave foránea
                $table->dropForeign(['articulo_id']); // Asegúrate de que el nombre sea correcto
                // Luego eliminamos la columna
                $table->dropColumn('articulo_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tiempos_produccions', function (Blueprint $table) {
            $table->unsignedBigInteger('articulo_id')->nullable(); // Asegúrate de que sea nullable si no quieres que sea obligatorio
            // Agrega la relación de clave foránea
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
        });
    }
};
