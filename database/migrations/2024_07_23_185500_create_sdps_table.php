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
        Schema::create('sdps', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_sdp')->unique();
            $table->bigInteger('cliente_nit');
            $table->unsignedBigInteger('vendedor_id');
            $table->integer('cantidad');
            $table->string('descripcion', 255);
            $table->string('material', 255);
            $table->date('fecha_despacho_comercial');
            $table->date('fecha_despacho_produccion')->nullable();
            $table->string('plano', 255)->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->string('requisitos_cliente', 255)->nullable();
            $table->decimal('precio', 10, 2);
            $table->timestamps();

            $table->foreign('cliente_nit')->references('nit')->on('clientes')->onDelete('cascade');
            $table->foreign('vendedor_id')->references('id')->on('vendedores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sdps');
    }
};