<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dias extends Model
{
    use HasFactory;


    protected $fillable = [
        'dias_trabajados', 'dias_remunerados', 'dias_incapacidad',
        'dias_vacaciones', 'dias_no_remunerados', 'trabajador_id', 'nomina_id'
    ];
    public function nomina()
    {
        return $this->belongsTo(Nominas::class, 'nomina_id');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'trabajador_id');
    }
}