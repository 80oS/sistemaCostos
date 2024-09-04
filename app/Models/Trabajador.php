<?php

namespace App\Models;

use App\Enums\Departamento;
use App\Enums\estado_civil;
use App\Enums\sexo;
use App\Enums\TipoPago;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Trabajador extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_identificacion',
        'nombre',
        'apellido',
        'edad',
        'telefono_fijo',
        'correo',
        'cargo',
        'estado_civil',
        'sexo',
        'fecha_nacimiento',
        'fecha_expedicion',
        'fecha_ingreso',
        'lugar_nacimiento',
        'direccion',
        'ciudad',
        'celular',
        'ARL',
        'Eps',
        'alergias',
        'tipo_sangre',
        'nombre_persona_contacto',
        'parentesco_con_persona_contacto',
        'telefono_celular_persona_contacto',
        'cuenta_bancaria',
        'ciudad_expedicion',
        'fondo_pencion',
        'fondo_cesantias',
        'caja',
        'hijos_count',
        'nombre_conyuge',
        'fecha_nacimiento_conyuge',
        'numero_documento_conyuge',
        'fecha_expedicion_conyuge',
        'lugar_expedicion_conyuge',
        'tipo_pago',
        'departamentos',
        'contrato',
        'estado'
    ];

    protected $casts = [
        'sexo' => sexo::class,
        'estado_civil' => estado_civil::class,
        'departamentos' => Departamento::class,
        'tipo_pago' => TipoPago::class,
    ];

    public function sueldos()
    {
        return $this->hasMany(Sueldo::class, 'trabajador_id');
    }

    public function hijos()
    {
        return $this->hasMany(Hijo::class, 'trabajador_id');
    }

    public function nominas()
    {
        return $this->hasMany(Nominas::class);
    }

    public function dias()
    {
        return $this->hasMany(Dias::class);
    }

    public function operativos()
    {
        return $this->hasMany(Operativo::class);
    }
}