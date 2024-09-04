<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\codigoMPI;

class MateriaPrimaIndirecta extends Model
{
    use HasFactory;
    use codigoMPI;

    protected $fillable = [
        'codigo',
        'descripcion',
        'proveedor',
        'numero_factura',
        'numero_orden_compra',
        'precio_unit',
        'valor',
        'sdp_id'
    ];

    public static function boot()
    {
        parent::boot();
        self::bootCodigoMPI();
    }

    public function costosProduccion()
    {
        return $this->belongsToMany(costosProduccion::class, 'materia_prima_indirectas_costos')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
