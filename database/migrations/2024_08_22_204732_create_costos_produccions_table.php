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
        Schema::create('costos_produccions', function (Blueprint $table) {
            $table->id();
            $table->decimal('mano_obra_directa', 20, 2);
            $table->unsignedBigInteger('sdp_id');
            $table->timestamps();

            $table->foreign('sdp_id')->references('id')->on('sdps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costos_produccions');
    }
};
