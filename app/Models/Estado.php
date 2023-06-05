<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';
    protected $fillable = ['nome'];

    public function cidades()
    {
        return $this->hasMany(Cidade::class, 'estado_id');
    }
}
