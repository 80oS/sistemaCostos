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
        Schema::create('horas__extras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trabajadores_id');
            $table->float('valor_bono');
            $table->float('horas_diurnas');
            $table->float('horas_nocturnas');
            $table->float('horas_festivos');
            $table->float('horas_recargo_nocturno');
            $table->timestamps();

            $table->foreign('trabajadores_id')->references('id')->on('trabajadors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horas__extras');
    }
};