<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministraciónInventarioController extends Controller
{
    public function index()
    {
        return view('AdministraciónInventario.index');
    }
}
