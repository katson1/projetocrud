<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidade';
    protected $fillable = ['nome', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'cidade_id');
    }
}
