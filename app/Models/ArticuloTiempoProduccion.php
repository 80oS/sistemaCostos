<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ArticuloTiempoProduccion extends Model
{
    use HasFactory;

    protected $table = 'articulo_tiempos_produccion';

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function tiempoProduccion()
    {
        return $this->belongsTo(Tiempos_produccion::class);
    }

    public function costosProduccion()
    {
        return $this->belongsTo(CostosProduccion::class);
    }
}
