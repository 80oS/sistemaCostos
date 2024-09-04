<?php

namespace App\Http\Controllers;

use App\Models\Materia_Primas;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class MateriaPrimasController extends Controller
{
    public function index()
    {
        return view('materias_primas.index',);
    }
}
