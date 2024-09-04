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
            $table->decimal('tiempo_valor_total', 20, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tiempos_produccions', function (Blueprint $table) {
            $table->dropColumn('tiempo_valor_total');
        });
    }
};
