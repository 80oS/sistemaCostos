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
            $table->decimal('valor_bono', 20, 2)->change();
            $table->decimal('horas_diurnas', 20, 2)->change();
            $table->decimal('horas_nocturnas', 20, 2)->change();
            $table->decimal('horas_festivos', 20, 2)->change();
            $table->decimal('horas_recargo_nocturno', 20, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horas_extras', function (Blueprint $table) {
            $table->float('valor_bono');
            $table->float('horas_diurnas');
            $table->float('horas_nocturnas');
            $table->float('horas_festivos');
            $table->float('horas_recargo_nocturno');
        });
    }
};