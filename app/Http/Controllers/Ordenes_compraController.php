<?php

namespace App\Http\Controllers;

use App\Models\Ordenes;
use App\Models\Articulos;
use App\Models\IVA;
use Illuminate\Http\Request;

class Ordenes_compraController extends Controller
{
    public function index()
    {
        return view('ordenesCompra.index');
    }

    public function create()
    {   
        return view('ordenesCompra.create');
    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}