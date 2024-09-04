<?php

use App\Enums\estado_civil;
use App\Enums\sexo;
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
        Schema::table('trabajadors', function (Blueprint $table) {
            // Verifica y elimina la columna estado_civil si existe
            if (Schema::hasColumn('trabajadors', 'estado_civil')) {
                $table->dropColumn('estado_civil');
            }

            // Verifica y elimina la columna sexo si existe
            if (Schema::hasColumn('trabajadors', 'sexo')) {
                $table->dropColumn('sexo');
            }
        });

        Schema::table('trabajadors', function (Blueprint $table) {
            $table->enum('estado_civil', array_column(estado_civil::cases(), 'value'))->nullable();
            $table->enum('sexo', array_column(sexo::cases(), 'value'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trabajadors', function (Blueprint $table) {
            // Verifica y elimina la columna estado_civil si existe
            if (Schema::hasColumn('trabajadors', 'estado_civil')) {
                $table->dropColumn('estado_civil');
            }

            // Verifica y elimina la columna sexo si existe
            if (Schema::hasColumn('trabajadors', 'sexo')) {
                $table->dropColumn('sexo');
            }
        });

        Schema::table('trabajadors', function (Blueprint $table) {
            $table->enum('estado_civil', ['soltero', 'soltera', 'casado', 'casada', 'union_libre', 'divorciado', 'divorciada'])->nullable();
            $table->enum('sexo', ['masculino', 'femenino', 'otro'])->nullable();
        });
    }
};