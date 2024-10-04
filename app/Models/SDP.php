<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SDP extends Model
{
    use HasFactory;

    protected $table = 'sdps';

    protected $primaryKey = 'numero_sdp';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'numero_sdp', 
        'cliente_nit', 
        'vendedor_id',
        'fecha_despacho_comercial',
        'fecha_despacho_produccion',
        'observaciones',
        'requisitos_cliente',
        'orden_compra',
        'memoria_calculo'
    ];

    public function Tiempos_produccion()
    {
        return $this->hasMany(Tiempos_produccion::class, 'sdp_id', 'numero_sdp');
    }

    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'cliente_nit', 'nit');
    }

    public function vendedores()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id');
    }

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'articulo_sdp', 's_d_p_id', 'articulo_id')
                    ->withPivot('cantidad', 'precio');
    }

    public function costosProduccion()
    {
        return $this->hasMany(CostosProduccion::class, 'sdp_id', 'numero_sdp');
    }

    public function numero_sdp()
    {
        $ultimoSDP = SDP::latest('id')->first();
        $nuevoNumeroSDP = $ultimoSDP ? $ultimoSDP->numero_sdp + 1 : 1;
        return $nuevoNumeroSDP;
    }

    public function serviciosCostos()
    {
        return $this->hasMany(ServicioCostos::class, 'sdp_id', 'numero_sdp'); // Asegúrate de que 'numero_sdp' es la clave primaria de SDP
    }
}