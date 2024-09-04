<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\codigoMPD;

class MateriaPrimaDirecta extends Model
{
    use HasFactory;
    use codigoMPD;

    protected $fillable = [
        'codigo',
        'descripcion',
        'proveedor',
        'numero_factura',
        'numero_orden_compra',
        'precio_unit',
        'valor'
    ];

    public function costosProduccion()
    {
        return $this->belongsToMany(costosProduccion::class, 'materia_prima_directas_costos')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
