<?php

namespace App\Http\Controllers;

use App\Services\PostagemService;
use Illuminate\Http\Request;

class PostagensController extends Controller
{

    public function __construct(PostagemService $service){
        $this->service = $service;
    }

    //
    public function listaComentario($postagem_id, Request $request){
        $page = 1;
        if ($request->input('page')) {
            $page = $request->input('page');
        }
        $minutes = \Carbon\Carbon::now()->addHours(3);
        $comentarios = \Cache::remember('api::comentarios::postagem-'.$postagem_id.'-page-'.$page, $minutes, function () use ($postagem_id,$page) {
             return $this->service->listaComentarioByPost($postagem_id, $page);
        });

        return response()->json($comentarios, 200);
    }
}
