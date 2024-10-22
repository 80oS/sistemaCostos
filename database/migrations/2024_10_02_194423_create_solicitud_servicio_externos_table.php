<?php

use App\Enums\Departamento;
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
        Schema::create('solicitud_servicio_externos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_ste')->unique();
            $table->string('observaciones')->nullable();
            $table->string('despacho')->nullable();
            $table->enum('departamento', array_column(Departamento::cases(), 'value'));
            $table->string('recibido')->nullable();
            $table->date('fecha_salida_planta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_servicio_externos');
    }
};
