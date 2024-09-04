<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TalentoHConroller extends Controller
{
    public function index()
    {
        $data = [
            'gestion_humana' => 'gestion humana'
        ];
        return view('talento.index', $data);
    }

    public function nomina ()
    {
        return view('nomina.nomina');
    }
}
