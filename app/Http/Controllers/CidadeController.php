<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        $cidades = Cidade::all();
        return view('cidades.index', compact('cidades'));
    }

    public function show(Cidade $cidade)
    {
        return view('cidades.show', compact('cidade'));
    }

    public function getCidadesPorEstado($estadoId)
    {
        $cidades = Cidade::where('estado_id', $estadoId)->get();

        return response()->json($cidades);
    }
}
