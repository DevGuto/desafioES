<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';

    protected $fillable = ['comentario', 'usuario_id', 'postagem_id'];
    
    public function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function postagem() {
        return $this->belongsTo('App\Models\Postagem');
    }
}
