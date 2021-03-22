<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacoes';

    protected $fillable = ['postagem_id', 'usuario_id', 'data_visualizou'];

    public function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function postagem() {
        return $this->belongsTo('App\Models\Postagem');
    }
}
