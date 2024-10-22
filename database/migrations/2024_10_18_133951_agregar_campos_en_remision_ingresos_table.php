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
        Schema::table('remision_ingresos', function (Blueprint $table) {
            $table->string('cliente_nit')->nullable();
            $table->foreign('cliente_nit')->references('nit')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('remision_ingresos', function (Blueprint $table) {
            $table->dropForeign(['cliente_nit']);
            $table->dropColumn('cliente_nit');
        });
    }
};
