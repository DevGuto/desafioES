<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = ['nome', 'login', 'senha', 'assinante'];
    
    protected $hidden = ['senha'];

    public function postagens()
    {
        return $this->hasMany('App\Models\Postagem');
    }

    public function comentarios()
    {
        return $this->hasMany('App\Models\Comentario');
    }

}
