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
            $table->decimal('bonificacion_auxilio', 20, 2)->default(0);
            $table->unsignedBigInteger('nomina_id');
            $table->foreign('nomina_id')->references('id')->on('nominas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('sueldos', function (Blueprint $table) {
            $table->dropForeign('nomina_id');
            $table->dropColumn(['bonificacion_auxilio','nomina_id']);
        });
    }
};
