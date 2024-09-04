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
        Schema::table('remiciones', function (Blueprint $table) {
            $table->dropForeign('remiciones_cliente_nit_foreign');
            $table->dropColumn('cliente_nit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->bigInteger('cliente_nit');
            $table->foreign('cliente_nit')->references('nit')->on('clientes')->onDelete('cascade');
        });
    }
};
