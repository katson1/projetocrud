<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Hobbie;
use App\Models\Estado;
use App\Models\UsuarioHobbie;
use App\Http\Controllers\UsuarioHobbieController;
use Illuminate\Database\QueryException;



class UsuarioController extends Controller
{
    public function index()
    {
        $estados = Estado::all();
        $hobbies = Hobbie::all();
        $usuarios = Usuario::all();

        return view('create', compact('estados', 'hobbies','usuarios'));
    }

    public function create()
    {
        $estados = Estado::all();
        $hobbies = Hobbie::all();
        $usuarios = Usuario::all();

        return view('create', compact('estados', 'hobbies','usuarios'));
    }

    public function store(Request $request)
    {
        try {
            $usuario = Usuario::create($request->all());
            $usuariohobbies = new UsuarioHobbieController;
            $usuariohobbies->store($request->all()["hobbies"], $usuario->id);
            return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                $errorMessage = 'Já existe um usuário com o e-mail fornecido!';
            } else {
                $errorMessage = 'Erro no banco.';
            }
            
            return redirect()->back()->with('warning', $errorMessage)->withInput();
        }
    }

    public function edit(Usuario $usuario)
    {
        $estados = Estado::all();
        $hobbies = Hobbie::all();
        $usuariohobbies = new UsuarioHobbieController;
        $hobbiesantigos = $usuariohobbies->buscarPorUsuarioId($usuario->id)->toArray();
        $hobbieIds = array_map(function ($item) {
            return $item['hobbie_id'];
        }, $hobbiesantigos);
        return view('usuarios.edit', compact('usuario', 'estados', 'hobbies','hobbieIds'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $usuario->update($request->all());
        $usuariohobbies = new UsuarioHobbieController;
        $usuariohobbies->delete($usuario->id);
        $usuariohobbies->store($request->all()["hobbies"], $usuario->id);
        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuariohobbies = new UsuarioHobbieController;
        $usuariohobbies->delete($usuario->id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso.');
    }
}
