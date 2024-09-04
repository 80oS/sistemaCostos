<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TipoDocumentoHijo;

class Hijo extends Model
{
    use HasFactory;
    
    protected $table = 'hijos';
    
    protected $fillable = [
        'nombre',
        'trabajador_id',
        'fecha_nacimiento',
        'edad',
        'tipo_documento',
        'numero_documento',
    ];

    protected $casts = [
        'tipo_documento' => TipoDocumentoHijo::class,
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'trabajador_id');
    }
}
