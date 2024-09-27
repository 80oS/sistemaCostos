<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\codigoArt;

class Articulo extends Model
{
    use HasFactory;
    use codigoArt;

    protected $fillable = [
        'codigo',
        'descripcion',
        'material',
        'plano',
    ];

    protected static function boot()
    {
        parent::boot();
        self::bootCodigoArt();
    }

    public function sdps()
    {
        return $this->belongsToMany(Sdp::class, 'articulo_sdp')
                    ->withPivot('cantidad', 'precio', 's_d_p_id', 'articulo_id')
                    ->withTimestamps();
    }

    public function tiemposProduccion()
    {
        return $this->belongsToMany(Tiempos_produccion::class, 'articulo_tiempos_produccion', 'articulo_id', 'tiempos_produccion_id');
    }
}