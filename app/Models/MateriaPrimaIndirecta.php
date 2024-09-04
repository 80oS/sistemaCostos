<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrimaIndirecta extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'proveedor',
        'numero_factura',
        'numero_orden_compra',
        'precio_unit',
        'valor',
        'sdp_id'
    ];

    public function costosProduccion()
    {
        return $this->belongsToMany(costosProduccion::class, 'materia_prima_indirectas_costos')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    public function sdp()
    {
        return $this->belongsTo(Sdp::class, 'sdp_id', 'numero_sdp');
    }
}
