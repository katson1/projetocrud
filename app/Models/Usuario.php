<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nome', 'email', 'cidade_id'];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobbie::class, 'usuario_hobbie', 'usuario_id', 'hobbie_id');
    }
}
