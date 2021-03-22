<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsuarioService;

class UsuariosController extends Controller
{
    public function __construct(UsuarioService $service){
        $this->service = $service;
    }

    //
    public function listaNotificacoes($usuario_id){
        $notificacoes = $this->service->listaNotificacoesByUsuario($usuario_id);
        return response()->json($notificacoes, 200);
    }
}
