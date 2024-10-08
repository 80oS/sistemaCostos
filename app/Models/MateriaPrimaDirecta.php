<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\codigoMPD;

class MateriaPrimaDirecta extends Model
{
    use HasFactory;
    use codigoMPD;

    protected $table = 'materia_prima_directas';

    protected $fillable = [
        'codigo',
        'descripcion',
        'proveedor',
        'numero_factura',
        'numero_orden_compra',
        'precio_unit',
        'valor'
    ];

    public static function boot()
    {
        parent::boot();
        self::bootCodigoMPD();
    }

    public function costosProduccion()
    {
        return $this->belongsToMany(CostosProduccion::class, 'materia_prima_directas_costos')
                    ->withPivot('id','cantidad', 'materia_prima_directa_id', 'costos_produccion_id',)
                    ->withTimestamps();
    }
}
