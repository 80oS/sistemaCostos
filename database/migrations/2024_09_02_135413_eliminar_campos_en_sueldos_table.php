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
        Schema::table('sueldos', function (Blueprint $table) {
            $table->dropForeign('sueldos_nomina_id_foreign');
            $table->dropColumn(['nomina_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sueldos', function (Blueprint $table) {
            $table->unsignedBigInteger('nomina_id');
            $table->foreign('nomina_id')->references('id')->on('nominas')->onDelete('cascade');
        });
    }
};
