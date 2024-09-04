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
            $table->dropColumn(['cantidad', 'descripcion', 'material', 'plano', 'precio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sdps', function (Blueprint $table) {
            $table->integer('cantidad');
            $table->string('descripcion', 255);
            $table->string('material', 255);
            $table->string('plano', 255)->nullable();
            $table->decimal('precio', 10, 2);
        });
    }
};