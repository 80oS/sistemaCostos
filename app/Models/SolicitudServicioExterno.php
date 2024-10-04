<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudServicioExterno extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_ste',
        'sdp',
        'observaciones',
        'despecho',
        'recibido'
    ];

    public function itemSTE()
    {
        return $this->hasMany(ItemSTE::class);
    }

}
