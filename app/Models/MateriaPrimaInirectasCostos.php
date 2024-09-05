<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrimaInirectasCostos extends Model
{
    use HasFactory;

    protected $table = 'materia_prima_indirectas_costos';

    protected $fillable = [
        'materia_prima_indirecta_id',
        'costos_produccion_id',
        'cantidad'
    ];
}
