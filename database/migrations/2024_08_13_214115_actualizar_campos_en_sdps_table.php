<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('sdps', function (Blueprint $table) {
            $table->dropForeign('sdps_cliente_nit_foreign');
            $table->dropColumn('cliente_nit');
        });
    }

    public function down(): void
    {
        Schema::table('sdps', function (Blueprint $table) {
            $table->unsignedBigInteger('cliente_nit');
            $table->foreign('cliente_nit')->references('nit')->on('clientes')->onDelete('cascade');
        });
    }
};
