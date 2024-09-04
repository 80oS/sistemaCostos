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
            $table->renameColumn('sdp_id', 's_d_p_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articulo_sdp', function (Blueprint $table) {
            $table->renameColumn('s_d_p_id', 'sdp_id');
        });
    }
};