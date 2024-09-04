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
        Schema::create('materia_Prima_Directas_costos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materia_prima_id')->constrained('materia_prima_directas')->onDelete('cascade');
            $table->foreignId('costo_produccion_id')->constrained('costos_produccions')->onDelete('cascade');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_prima_costos_produccion');
    }
};
