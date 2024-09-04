<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TipoDocumentoHijo;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hijos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->constrained('trabajadors')->onDelete('cascade');
            $table->string('nombre');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->enum('tipo_documento', array_column(TipoDocumentoHijo::cases(), 'value'));
            $table->string('numero_documento');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('hijos');
    }
};
