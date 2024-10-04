<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSTE extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitud_servicio_externo_id',
        'cantidad',
        'descripcion',
        'material',
        'tratamiento_termico',
        'dureza_HRC',
        'peso'
    ];

    public function solicitdServicioExterno()
    {
        return $this->belongsTo(SolicitudServicioExterno::class);
    }
}
