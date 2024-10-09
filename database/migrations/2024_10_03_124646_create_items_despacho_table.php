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
        Schema::create('items_despacho', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('remision_despacho_id');
            $table->unsignedBigInteger('item_id');
            $table->string('cantidad');
            $table->timestamps();

            $table->foreign('remision_despacho_id')->references('id')->on('remisiones_despacho')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_despacho');
    }
};