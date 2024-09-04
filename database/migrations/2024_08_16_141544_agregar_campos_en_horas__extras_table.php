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
            $table->string('operario_cod');

            $table->foreign('operario_cod')->references('codigo')->on('operativos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horas__extras', function (Blueprint $table) {
            $table->dropForeign('horas__extras_operario_cod_foreign');
            $table->dropColumn('operario_cod');
        });
    }
};
