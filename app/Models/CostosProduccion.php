<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CostosProduccion extends Model
{
    use HasFactory;

    protected $table = 'costos_produccions';

    protected $fillable = [
        'sdp_id',
        'mano_obra_directa',
        'cif_id',
        'tiempo_produccion_id'
    ];

    public function sdp()
    {
        return $this->belongsTo(SDP::class, 'sdp_id', 'numero_sdp');
    }

    public function cif()
    {
        return $this->belongsTo(Cif::class, 'cif_id',);
    }

    public function tiempo_produccion()
    {
        return $this->belongsTo(Tiempos_produccion::class, 'tiempo_produccion_id');
    }

    public function materiasPrimasDirectas()
    {
        return $this->belongsToMany(MateriaPrimaDirecta::class, 'materia_prima_directas_costos')
                    ->withPivot('id','cantidad', 'materia_prima_directa_id', 'costos_produccion_id',)
                    ->withTimestamps();
    }
    public function materiasPrimasIndirectas()
    {
        return $this->belongsToMany(MateriaPrimaIndirecta::class, 'materia_prima_indirectas_costos')
                    ->withPivot('id','cantidad', 'materia_indirecta_id', 'costos_produccion_id',)
                    ->withTimestamps();
    }

    public function calcularManoObraDirecta()
    {
        // Obtener el tiempo de producción asociado
        $tiempoProduccion = $this->tiempo_produccion;

        // Obtener el operativo asociado
        $operativo = $tiempoProduccion->operativo;
        $trabajador = $operativo->trabajador;

        if (!$trabajador) {
            Log::warning('Trabajador no encontrado para el operativo:', ['operativo_id' => $tiempoProduccion->operativo_id]);
            return null;
        }

        // Obtener el sueldo más reciente del trabajador
        $sueldo = $trabajador->sueldos()->orderBy('created_at', 'desc')->first()->sueldo ?? 0;

        // Obtener el CIF más reciente
        $cif = Cif::orderBy('created_at', 'desc')->first();
        $horasMes = $cif->NMH ?? 0;

        if ($horasMes > 0) {
            // Calcular el costo por hora
            $costoPorHora = $sueldo / $horasMes;
            // Calcular la mano de obra directa total
            $manoObraDirecta = $costoPorHora * $tiempoProduccion->horas;

            $this->mano_obra_directa = $manoObraDirecta;
            $this->save();
            return $manoObraDirecta;
        } else {
            Log::warning('Horas mes es cero o no está definido para el CIF:', ['cif' => $cif]);
            return null;
        }
    }
}
