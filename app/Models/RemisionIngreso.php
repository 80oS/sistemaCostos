<?php

namespace App\Models;

use App\Traits\codigoREM_ING;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemisionIngreso extends Model
{
    use HasFactory;
    use codigoREM_ING;

    protected $fillable = [
        'codigo',
        'proveedor_id',
        'fecha_ingreso',
        'observaciones',
        'despacho',
        'recibido'
    ];

    protected static function boot()
    {
        parent::boot();
        self::bootCodigoREM_ING();
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_ingreso', '	remision_ingreso_id', 'item_id')
                    ->withPivot('cantidad');
    }
}
