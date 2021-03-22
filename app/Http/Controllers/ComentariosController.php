<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ComentarioService;

class ComentariosController extends Controller
{
    public function __construct(ComentarioService $service){
        $this->service = $service;
    }

    // metodo que vai salvar os comentarios
    /**
     * Endpoint responsavel por salvar comentario
     */
    public function salvar(Request $request){
        $validator = $this->service->comentarioValidator($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validador Falhou',
                'errors'  => $validator->errors()
            ], 422); 
        }

        $comentario = $this->service->salvar($request);

        //\Cache::forget('api::comentarios::postagem-'.$request->get('postagem_id'));
        \Cache::flush();
        return response()->json($comentario, 201);
    }

}
