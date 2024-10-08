<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\codigoItem;

class Item extends Model
{
    use HasFactory;
    use codigoItem;

    protected $fillable = [
        'codigo',
        'descripcion'
    ];

    public static function boot()
    {
        parent::boot();
        self::bootCodigoItem();
    }

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
