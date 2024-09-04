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
        Schema::table('articulos', function (Blueprint $table) {
            // Eliminar la clave foránea antes de eliminar la columna
            $table->dropForeign(['SDP_id']);
            // Eliminar la columna
            $table->dropColumn('SDP_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articulos', function (Blueprint $table) {
            // Volver a añadir la columna
            $table->unsignedBigInteger('SDP_id');
            // Volver a añadir la clave foránea
            $table->foreign('SDP_id')->references('id')->on('sdps')->onDelete('cascade');
        });
    }
};