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
        Schema::create('remiciones', function (Blueprint $table) {
            $table->string('codigo_remicion', 36)->primary();
            $table->bigInteger('cliente_nit');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->date('fecha_despacho');
            $table->string('solicitud_produccion');
            $table->string('observaciones')->nullable();
            $table->string('recibido');
            $table->string('despacho');
            $table->timestamps();

            $table->foreign('cliente_nit')->references('nit')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remiciones');
    }
};
