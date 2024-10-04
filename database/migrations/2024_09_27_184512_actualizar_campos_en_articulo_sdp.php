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
        Schema::table('articulo_sdp', function (Blueprint $table) {
            $table->dropForeign('articulo_sdp_sdp_id_foreign');
            $table->integer('s_d_p_id')->change();
            $table->foreign('s_d_p_id')->references('numero_sdp')->on('sdps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articulo_sdp', function (Blueprint $table) {
            $table->dropForeign('articulo_sdp_sdp_id_foreign');
            $table->unsignedBigInteger('s_d_p_id')->change();
            $table->foreign('s_d_p_id')->references('id')->on('sdps')->onDelete('cascade');
        });
    }
};
