<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSTE extends Model
{
    use HasFactory;

    protected $table = 'items_ste';

    protected $fillable = [
        'descripcion',
        'servicio_requerido',
        'dureza_HRC'
    ];

    public function solicitdServicioExterno()
    {
        return $this->belongsToMany(SolicitudServicioExterno::class, 'items_ste_cantidad', 'item_ste_id', 'solicitud_servicio_externo_id')
                    ->withPivot('cantidad');
    }
}
