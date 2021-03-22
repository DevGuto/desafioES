<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    protected $table = 'postagens';
    
    protected $fillable = ['titulo', 'descricao', 'usuario_id'];

    public function usuario() {
        return $this->belongsTo('App\Models\Usuario');
    }
}
