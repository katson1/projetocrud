<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::all();
        return view('estados.index', compact('estados'));
    }

    public function show(Estado $estado)
    {
        return view('estados.show', compact('estado'));
    }
}
