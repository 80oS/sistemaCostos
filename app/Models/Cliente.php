<?php

namespace App\Models;

use App\Enums\Comerciales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'nit';
    
    public $incrementing = false;

    protected $keyType = 'number';

    protected $fillable = [
        'nit',
        'nombre',
        'direccion',
        'telefono',
        'contacto',
        'correo',
        'ciudad',
        'departamento',
        'comerciales_id',
    ];


    public function SDP()
    {
        return $this->hasMany(SDP::class, 'cliente_nit', 'nit');
    }

    public function remiciones()
    {
        return $this->hasMany(remicion::class);
    }

    public function vendedores()
    {
        return $this->belongsTo(vendedor::class, 'comerciales_id');
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamento::class, 'departamento');
    }

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'ciudad');
    }

    public function remisionIngreso()
    {
        return $this->hasMany(RemisionIngreso::class, 'cliente_nit', 'nit');
    }
}