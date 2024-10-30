<?php

namespace App\Models;

use App\Traits\codigoOrdenCompra;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;
    use codigoOrdenCompra;

    protected $table = 'proveedores';

    protected $fillable = [
        'numero',
        'proveedor_id',
        'fecha_orden',
        'subtotal',
        'iva',
        'total'
    ];

    protected static function boot()
    {
        parent::boot();
        self::bootcodigoOrdenCompra();
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function materiaPrimaDirecta()
    {
        return $this->hasMany(MateriaPrimaDirecta::class);
    }

    public function materiaPrimaIdirecta()
    {
        return $this->hasMany(MateriaPrimaIndirecta::class);
    }
}
