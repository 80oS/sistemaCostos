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
        Schema::table('materia_prima_indirectas', function (Blueprint $table) {
            $table->string('proveedor_id')->after('numero_orden_compra');
            $table->foreign('proveedor_id')->references('nit')->on('proveedores')->onDelete('cascade');
            $table->foreign('numero_orden_compra')->references('numero')->on('orden__compras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materia_prima_indirectas', function (Blueprint $table) {
            $table->dropForeign(['proveedor_id', 'numero_orden_compra']);
            $table->dropColumn('proveedor_id');
        });
    }
};
