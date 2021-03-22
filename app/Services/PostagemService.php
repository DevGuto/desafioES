<?php

namespace App\Services;

use App\Models\Postagem;
use DB;

class PostagemService
{
    public function __construct(Postagem $postagem){
        $this->postagem = $postagem;
    }

    public function listaComentarioByPost($postagem_id, $page){
        $paginacao = 15;
        //dd($paged);
        return DB::table('comentarios')
                ->leftJoin('usuarios', 'usuarios.id', '=', 'comentarios.usuario_id')
                ->select('usuarios.id as usuario_id', 
                        'comentarios.id as comentario_id', 
                        'usuarios.login', 
                        'usuarios.assinante', 
                        'comentarios.created_at', 
                        'comentarios.comentario'
                        )
                ->where('comentarios.postagem_id', '=', $postagem_id)
                ->orderBy('created_at', 'asc')
                ->paginate($paginacao)->appends('page', $page);
                //->get();
    }

    /**
     * Metodo responsavel por buscar usuario por postagem
     */
    public function getUsuarioByPost($postagem_id){
        return $this->postagem->findOrFail($postagem_id)->usuario()->first();
    }

}