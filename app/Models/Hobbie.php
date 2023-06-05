<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model
{
    protected $table = 'hobbies';
    protected $fillable = ['nome'];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_hobbie', 'hobbie_id', 'usuario_id');
    }
}
