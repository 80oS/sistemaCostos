<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioCostos extends Model
{
    use HasFactory;
    
    protected $table='servicios_costos';

    public function servicios ()
    {
        return $this->belongsTo(Servicio::class);
    }
    public function costosProduccion ()
    {
        return $this->belongsTo(CostosProduccion::class);
    }
    public function sdp ()
    {
        return $this->belongsTo(SDP::class);
    }
}
