<?php

namespace App\Services;

use App\Models\Usuario;
use DB;

class UsuarioService
{
    // Const definida para fixar valor de horas que pode exibir apos ser visualizada
    const HORASAPOSEXIBICAO = 3;

    public function __construct(Usuario $usuario){
        $this->usuario = $usuario;
    }

    /**
     * Metodo listar notificações de comentarios por id de usuario,
     *
     */
    public function listaNotificacoesByUsuario($usuario_id){
        $this->visualizou($usuario_id);
        return DB::table('notificacoes')
        ->leftJoin('comentarios', 'comentarios.postagem_id', '=', 'notificacoes.postagem_id')
        ->leftJoin('usuarios', 'usuarios.id', '=', 'notificacoes.usuario_id')
        ->select('usuarios.id as usuario_id', 
                'comentarios.id as comentario_id', 
                'usuarios.login', 
                'comentarios.comentario',
                'notificacoes.created_at'
                )
        ->where('notificacoes.usuario_id', '=', $usuario_id)
        ->whereNull('notificacoes.data_visualizou')
        ->orWhere('notificacoes.data_visualizou', '>',\Carbon\Carbon::now()->toDateTimeString())
        ->orderBy('notificacoes.created_at', 'asc')
        ->get();
    }

    /**
     * Metodo responsavel por adicionar data e hora de visualiação das notificacoes
     */
    public function visualizou($usuario_id){
        DB::table('notificacoes')
                ->where('usuario_id', $usuario_id)
                ->whereNull('data_visualizou')
            ->update([
                'data_visualizou' => \Carbon\Carbon::now()->addHours(UsuarioService::HORASAPOSEXIBICAO)->toDateTimeString()
                ]);

    }

}