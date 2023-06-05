<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioHobbie extends Model
{
    protected $table = 'usuario_hobbie';
    public $timestamps = true;

    protected $fillable = ['usuario_id', 'hobbie_id'];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function hobbie()
    {
        return $this->belongsTo(Hobbie::class, 'hobbie_id');
    }
}
