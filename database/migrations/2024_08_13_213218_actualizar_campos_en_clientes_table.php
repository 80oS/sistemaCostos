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
        Schema::table('clientes', function (Blueprint $table) {


            $table->string('direccion')->nullable()->change();
            $table->string('correo')->nullable()->change();
            $table->unsignedBigInteger('departamento')->nullable()->change();
            $table->unsignedBigInteger('ciudad')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('direccion')->nullable()->change();
            $table->string('correo')->nullable()->change();
            $table->unsignedBigInteger('departamento')->nullable()->change();
            $table->unsignedBigInteger('ciudad')->nullable()->change();
        });
    }
};
