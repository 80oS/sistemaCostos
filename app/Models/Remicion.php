<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Remicion extends Model
{
    use HasFactory;

    protected $table = 'remisiones_despacho';

    protected $fillable = [
        'codigo',
        'cliente_id',
        'fecha_despacho',
        'sdp_id',
        'observaciones',
        'despacho',
        'departamento',
        'recibido'
    ];
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'nit');
    }

    public function sdp()
    {
        return $this->belongsTo(SDP::class, 'sdp_id', 'numero_sdp');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_despacho', 'remision_despacho_id', 'item_id')
                    ->withPivot('cantidad');
    }
}