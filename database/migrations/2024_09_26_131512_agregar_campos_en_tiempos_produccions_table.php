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
            $table->foreignId('articulo_id')->constrained('articulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tiempos_produccions', function (Blueprint $table) {
            $table->dropForeign('tiempos_produccions_articulo_id_foreign');
        });
    }
};
