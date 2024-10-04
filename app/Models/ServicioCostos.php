<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioCostos extends Model
{
    use HasFactory;
    
    protected $table='servicios_costos';

    protected $fillable = [
        'servicio_id',
        'costos_produccion_id',
        'sdp_id',
        'valor_servicio'
    ];

    public function servicio() {
        return $this->belongsTo(Servicio::class, 'servicio_id', 'codigo');
    }

    public function costosProduccion() {
        return $this->belongsTo(CostosProduccion::class, 'costos_produccion_id', 'id');
    }

    public function sdp ()
    {
        return $this->belongsTo(SDP::class);
    }

    public function tiemposProduccion()
    {
        return $this->belongsToMany(Tiempos_produccion::class, 'tiempos_produccion_servicios_costos', 'servicio_costos_id', 'tiempo_produccion_id');
    }
}
