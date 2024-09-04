<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Departamento;
use App\Enums\TipoDocumentoHijo;
use App\Enums\TipoPago;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->id();
            $table->string('numero_identificacion');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('edad');
            $table->string('telefono_fijo');
            $table->string('correo')->unique();
            $table->string('cargo');
            $table->enum('estado_civil', ['soltero', 'soltera', 'casado', 'casada', 'union_libre', 'divorciado', 'divorciada']);
            $table->enum('sexo', ['masculino', 'femenino', 'otro']);
            $table->date('fecha_nacimiento');
            $table->date('fecha_expedicion');
            $table->date('fecha_ingreso');
            $table->string('lugar_nacimiento');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('celular');
            $table->string('ARL');
            $table->string('Eps');
            $table->string('alergias')->nullable();
            $table->string('tipo_sangre');
            $table->string('nombre_persona_contacto')->nullable();
            $table->string('parentesco_con_persona_contacto')->nullable();
            $table->string('telefono_celular_persona_contacto')->nullable();
            $table->string('cuenta_bancaria');
            $table->string('ciudad_expedicion');
            $table->string('fondo_pencion');
            $table->string('fondo_cesantias');
            $table->string('caja');
            $table->integer('hijos_count')->default(0);
            $table->string('nombre_conyuge')->nullable();
            $table->date('fecha_nacimiento_conyuge')->nullable();
            $table->string('numero_documento_conyuge')->nullable();
            $table->date('fecha_expedicion_conyuge')->nullable();
            $table->string('lugar_expedicion_conyuge')->nullable();
            $table->enum('tipo_pago', array_column(TipoPago::cases(), 'value'));
            $table->enum('departamentos', array_column(Departamento::cases(), 'value'));
            $table->string('contrato')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadors');
    }
};