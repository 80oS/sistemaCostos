<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemisionIngreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'proveedor_id',
        'fecha_ingreso',
        'observaciones',
        'despacho',
        'recibido'
    ];

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
