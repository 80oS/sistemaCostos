<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\codigoAlf;

class Servicio extends Model
{
    use HasFactory;
    use codigoAlf;

    protected $fillable = [
        'codigo',
        'nombre',
        'valor_hora'
    ];


    public function Tiempos_Produccion()
    {
        return $this->hasMany(Tiempos_produccion::class, 'proseso_id', 'codigo');
    }
    
    public function serviciosCostos() 
    {
        return $this->hasMany(ServicioCostos::class);
    }

    public function costosProduccion() 
    {
        return $this->belongsToMany(CostosProduccion::class, 'servicios_costos', 'servicio_id', 'costos_produccion_id')
            ->withPivot('valor_servicio', 'sdp_id');
    }

    public function sdps()
    {
        return $this->belongsToMany(SDP::class, 'servicio_s_d_p', 'servicio_id', 'sdp_id','codigo', 'numero_sdp')
                    ->withPivot('valor_servicio')
                    ->withTimestamps();
    }

}