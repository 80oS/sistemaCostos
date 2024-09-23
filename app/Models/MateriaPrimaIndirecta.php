<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\codigoMPI;

class MateriaPrimaIndirecta extends Model
{
    use HasFactory;
    use codigoMPI;

    protected $table = 'materia_prima_indirectas';

    protected $fillable = [
        'codigo',
        'descripcion',
        'proveedor',
        'numero_factura',
        'numero_orden_compra',
        'precio_unit',
        'valor',
    ];

    public static function boot()
    {
        parent::boot();
        self::bootCodigoMPI();
    }

    public function costosProduccion()
    {
        return $this->belongsToMany(CostosProduccion::class, 'materia_prima_indirectas_costos', 'costos_produccion_id', 'materia_indirecta_id')
                    ->withPivot('id','cantidad')
                    ->withTimestamps();
    }
}
