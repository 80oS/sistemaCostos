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
        Schema::table('horas__extras', function (Blueprint $table) {
            $table->dropForeign('horas__extras_trabajadores_id_foreign');

            $table->dropColumn('trabajadores_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horas__extras', function (Blueprint $table) {
            $table->unsignedBigInteger('trabajadores_id');

            $table->foreign('trabajadores_id')->references('id')->on('trabajadors')->onDelete('cascade');
        });
    }
};
