<?php

namespace App\Http\Controllers;

use App\Models\UsuarioHobbie;
use Illuminate\Http\Request;

class UsuarioHobbieController extends Controller
{
    public function buscarPorUsuarioId($usuarioId)
    {
        $hobbies = UsuarioHobbie::with('hobbie')->where('usuario_id', $usuarioId)->get();
        return $hobbies;

    }

    public function store(Array $hobbies, int $usuarioId)
    {
        foreach ($hobbies as $hobbieId) {
            UsuarioHobbie::create([
                'usuario_id' => $usuarioId,
                'hobbie_id' => $hobbieId
            ]);
        }

        return response()->json(['message' => 'Relações de hobbies criadas com sucesso']);
    }

    public function delete(int $usuarioId)
    {
        UsuarioHobbie::where('usuario_id', $usuarioId)
            ->delete();

        return response()->json(['message' => 'Relações de hobbies excluídas com sucesso']);
    }
}
