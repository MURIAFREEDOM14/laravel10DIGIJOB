<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function laman() : view
    {
        return view('laman');
    }

}
