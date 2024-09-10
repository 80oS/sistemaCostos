<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventario = Inventario::all();
    
        return view('inventario.actual', compact('inventario'));
    }

    public function bajoMinimos()
    {
        $productosBajoMinimos = Inventario::where('stock_actual', '<', 'stock_minimo')->get();
        return view('inventario.bajo_minimos', compact('productosBajoMinimos'));
    }
}
