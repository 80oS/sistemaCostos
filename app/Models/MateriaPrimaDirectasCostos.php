<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrimaDirectasCostos extends Model
{
    use HasFactory;

    protected $table = 'materia_prima_directas_costos';

    protected $fillable = [
        'materia_prima_directa_id',
        'costos_produccion_id',
        'cantidad'
    ];
}