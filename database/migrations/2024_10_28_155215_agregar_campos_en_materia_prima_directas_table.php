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
        Schema::table('materia_prima_directas', function (Blueprint $table) {
            $table->foreign('numero_orden_compra')->references('numero')->on('orden__compras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materia_prima_directas', function (Blueprint $table) {
            $table->dropForeign(['numero_orden_compra']);
        });
    }
};
