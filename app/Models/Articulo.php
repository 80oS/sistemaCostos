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
        return $this->belongsToMany(Sdp::class, 'articulo_sdp', 's_d_p_id', 'articulo_id')
                    ->withPivot('cantidad', 'precio');
    }

    public function tiemposProduccion()
    {
        return $this->belongsToMany(Tiempos_produccion::class, 'articulo_tiempos_produccion', 'articulo_id', 'tiempos_produccion_id');
    }

    public function materiasPrimasDirectas()
    {
        return $this->belongsToMany(MateriaPrimaDirecta::class, 'materia_prima_directas_costos', 'articulo_id', 'materia_prima_directa_id')
                    ->withPivot('cantidad', 'articulo_descripcion', 'costos_produccion_id');
    }

    public function materiasPrimasIndirectas()
    {
        return $this->belongsToMany(MateriaPrimaIndirecta::class, 'materia_prima_indirectas_costos', 'articulo_id', 'materia_indirecta_id')
                    ->withPivot('cantidad', 'articulo_descripcion', 'costos_produccion_id');
    }
}