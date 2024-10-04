<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'descripcion'
    ];

    public function remicionesDespacho()
    {
        return $this->belongsToMany(Remicion::class, 'items_despacho', 'remision_despacho_id', 'item_id')
                    ->withPivot('cantidad');
    }

    public function remisionesIngreso()
    {
        return $this->belongsToMany(RemisionIngreso::class, 'items_ingreso', '	remision_ingreso_id', 'item_id')
                    ->withPivot('cantidad');        
    }
}
