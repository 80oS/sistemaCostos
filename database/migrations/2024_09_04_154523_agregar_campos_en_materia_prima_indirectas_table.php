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
        Schema::table('materia_prima_indirectas', function (Blueprint $table) {
            $table->string('codigo')->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materia_prima_indirectas', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });
    }
};