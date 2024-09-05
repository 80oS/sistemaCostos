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
        Schema::create('materia_Prima_Indirectas_costos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materia_prima_indirecta_id')->constrained('materia_prima_indirectas')->onDelete('cascade');
            $table->foreignId('costos_produccion_id')->constrained('costos_produccions')->onDelete('cascade');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_prima_indirecta_costos_produccion');
    }
};
