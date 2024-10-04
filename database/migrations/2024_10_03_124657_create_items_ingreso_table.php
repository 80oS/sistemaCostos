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
        Schema::create('items_ingreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('remision_ingreso_id');
            $table->string('item_id');
            $table->integer('cantidad');
            $table->timestamps();

            
            $table->foreign('remision_ingreso_id')->references('id')->on('remision_ingresos')->onDelete('cascade');
            $table->foreign('item_id')->references('codigo')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_ingreso');
    }
};
