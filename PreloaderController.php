<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreloaderController extends Controller
{
    public function show()
    {
        return view('preloader');
    }
}