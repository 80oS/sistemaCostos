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
    { Schema::table('nominas', function (Blueprint $table) {
        // Primero, elimina la relación existente (si existe)
        $table->dropForeign(['paquete_nomina_id']);

        // Luego, añade la nueva relación con eliminación en cascada
        $table->foreign('paquete_nomina_id')
                ->references('id')
                ->on('paquete_nominas')
                ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nominas', function (Blueprint $table) {
            // Revertir los cambios si es necesario
            $table->dropForeign(['paquete_nomina_id']);
            $table->foreign('paquete_nomina_id')
                    ->references('id')
                    ->on('paquete_nominas');
        });
    }
};
