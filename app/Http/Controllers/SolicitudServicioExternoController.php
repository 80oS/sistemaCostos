<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolicitudServicioExternoController extends Controller
{
    public function index()
    {
        return view('solicitudServicioExterno.index');
    }
}
