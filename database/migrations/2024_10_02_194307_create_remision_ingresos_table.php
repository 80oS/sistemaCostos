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
        Schema::create('remision_ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->unsignedBigInteger('proveedor_id');
            $table->date('fecha_ingreso');
            $table->string('ovserbaciones')->nullable();
            $table->string('despacho')->nullable();
            $table->enum('departamento', array_column(Departamento::cases(), 'value'));
            $table->string('recibido')->nullable();
            $table->timestamps();

            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remision_ingresos');
    }
};