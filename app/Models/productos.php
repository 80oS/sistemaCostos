<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'codigo', 
        'descripcion', 
        'cantidad', 
        'precio', 
        'categoria_id', 
        'proveedor_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relación muchos a uno con Proveedor.
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    /**
     * Relación uno a muchos con movimientos.
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
