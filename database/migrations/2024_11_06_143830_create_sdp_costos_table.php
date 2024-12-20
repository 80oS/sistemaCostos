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
        Schema::create('sdp_costos', function (Blueprint $table) {
            $table->id();
            $table->integer('sdp_id');
            $table->unsignedBigInteger('costos_id');
            $table->decimal('mano_obra_directa', 20, 2);
            $table->decimal('valor_sdp', 20, 2);
            $table->decimal('nomina', 20, 2);
            $table->decimal('materias_primas_indirectas', 20, 2);
            $table->decimal('materias_primas_directas', 20, 2);
            $table->decimal('costos_indirectos_fabrica', 20, 2);
            $table->decimal('utilidad_bruta', 20, 2);
            $table->decimal('margen_bruto', 20, 2);
            $table->timestamps();

            $table->foreign('sdp_id')->references('numero_sdp')->on('sdps')->onDelete('cascade');
            $table->foreign('costos_id')->references('id')->on('costos_produccions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sdp_costos');
    }
};
