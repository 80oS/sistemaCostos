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
        'cargo',
        'estado_civil',
        'sexo',
        'fecha_nacimiento',
        'fecha_ingreso',
        'celular',
        'Eps',
        'cuenta_bancaria',
        'banco',
        'tipo_pago',
        'departamentos',
        'contrato',
        'estado'
    ];

    protected $casts = [
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