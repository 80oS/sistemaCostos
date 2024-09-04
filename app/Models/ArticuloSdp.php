<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloSdp extends Model
{
    use HasFactory;

    protected $table = 'articulo_sdp'; // Nombre de la tabla pivot


    protected $fillable = ['articulo_id', 's_d_p_id', 'cantidad'];


}