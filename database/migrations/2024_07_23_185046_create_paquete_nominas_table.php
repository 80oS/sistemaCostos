<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaqueteNominasTable extends Migration
{
    public function up()
    {
        Schema::create('paquete_nominas', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('año');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paquete_nominas');
    }
}