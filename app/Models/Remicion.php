<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Remicion extends Model
{
    use HasFactory;

    protected $primaryKey = 'codigo_remicion';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['descripcion','codigo_remicion','cantidad', 'fecha_despacho', 'solicitud_produccion',
    'observaciones', 'recibido','despacho' 
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->codigo_remicion)) {
                $model->codigo_remicion = self::generateUniqueCode();
            }
        });
    }


    public static function generateUniqueCode()
    {
        do {
            $code = 'REM-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        } while (self::where('codigo_remicion', $code)->exists());

        return $code;
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_nit', 'nit');
    }
}