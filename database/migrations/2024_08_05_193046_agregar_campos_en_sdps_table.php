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
        Schema::table('sdps', function (Blueprint $table) {
            $table->string('orden_compra')->nullable();
            $table->string('memoria_calculo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sdps', function (Blueprint $table) {
            $table->dropColumn(['orden_compra', 'memoria_calculo']);
        });
    }
};