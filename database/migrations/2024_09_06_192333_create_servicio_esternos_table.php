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
        Schema::create('servicio_esternos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('proveedor');
            $table->string('proveedor_id');
            $table->string('valor_hora');
            $table->timestamps();
            
            $table->foreign('proveedor_id')->references('nit')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_esternos');
    }
};
