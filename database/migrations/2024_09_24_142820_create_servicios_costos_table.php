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
        Schema::create('servicios_costos', function (Blueprint $table) {
            $table->id();
            $table->string('servicio_id');
            $table->unsignedBigInteger('costos_produccion_id');
            $table->integer('sdp_id');
            $table->decimal('valor_servicio', 20, 2);
            $table->timestamps();

            $table->foreign('servicio_id')->references('codigo')->on('servicios')->onDelete('cascade');
            $table->foreign('costos_produccion_id')->references('id')->on('costos_produccions')->onDelete('cascade');
            $table->foreign('sdp_id')->references('numero_sdp')->on('sdps')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios_costos');
    }
};
