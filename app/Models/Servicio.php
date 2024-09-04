<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\codigoAlf;

class Servicio extends Model
{
    use HasFactory;
    use codigoAlf;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'codigo',
        'nombre',
        'valor_hora'
    ];


    public function Tiempos_Produccion()
    {
        return $this->hasMany(Tiempos_produccion::class, 'proseso_id', 'codigo');
    }
}