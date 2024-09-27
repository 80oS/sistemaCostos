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
            $table->foreignId('tiempos_produccion_id')->constrained('tiempos_produccions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios_costos', function (Blueprint $table) {
            $table->dropForeign('servicios_costos_tiempos_produccion_id_foreign');
        });
    }
};
