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
        Schema::create('articulo_tiempos_produccion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiempos_produccion_id');
            $table->foreignId('articulo_id');
            $table->timestamps();

            $table->foreign('tiempos_produccion_id')->references('id')->on('tiempos_produccions')->onDelete('cascade');
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo_tiempos_produccion');
    }
};
