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
        Schema::table('costos_produccions', function (Blueprint $table) {
            $table->integer('sdp_id');
            $table->foreign('sdp_id')->references('numero_sdp')->on('sdps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('costos_produccions', function (Blueprint $table) {
            $table->dropForeign('costos_produccions_sdp_id_foreign');
            $table->dropColumn('sdp_id');
        });
    }
};
