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
        Schema::table('nominas', function (Blueprint $table) {
            // Añadir el nuevo campo
            $table->unsignedBigInteger('paquete_nomina_id')->nullable();

            // Establecer la clave foránea
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
            // Eliminar la clave foránea
            $table->dropForeign(['paquete_nomina_id']);
            
            // Eliminar el campo
            $table->dropColumn('paquete_nomina_id');
        });
    }
};
