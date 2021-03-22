<?php

namespace App\Services;

use App\Models\Comentario;
use App\Models\Usuario;
use App\Models\Notificacao;
use App\Models\Postagem;
use Validator;
use Illuminate\Http\Request;
use App\Services\PostagemService;
use App\Exceptions\GenericException;
use DB;

class ComentarioService
{
    // constante que indica o maximo de comentarios em segundos
    const MAXCOMENTARIOS = 1;
    // constante que indica os segundos
    const SEGUNDOSCOMENTARIOS = 5;

    public function __construct(Comentario $comentario){
        $this->comentario = $comentario;
    }

    /**
     * Metodo  validar inserção do comentario
     */
    public function validar(Request $request){
        $usuarioComentario = Usuario::findOrFail($request->get('usuario_id'));
        $this->validarLimiteComentarioSegundo($usuarioComentario->id);
        if(!$usuarioComentario->assinante){
            $usuarioPost = (new PostagemService(new Postagem()))->getUsuarioByPost($request->get('postagem_id'));
            if(!$usuarioComentario->assinante){
                $comprandoDestaque = $request->get('comprando_destaque');
                if(empty($comprandoDestaque) && !$comprandoDestaque){
                    throw new GenericException("Usuario não pode inserir comentario pois não é assinante e não está comprando destaque"); 
                } 
            }
        } 
    }

    /**
     * Metodo  limite de inserção de comentarios por segundos
     */
    public function validarLimiteComentarioSegundo($usuario_id){
        $quantidade = DB::table('comentarios')
                     ->select(DB::raw('count(*) as quantidade'))
                     ->where('usuario_id', '=', $usuario_id)
                     ->whereBetween('created_at', [
                                        \Carbon\Carbon::now()->subSeconds(ComentarioService::SEGUNDOSCOMENTARIOS)->toDateTimeString(),
                                        \Carbon\Carbon::now()->toDateTimeString()
                                        ]
                                    )
                     ->get();

        if(intval($quantidade[0]->quantidade) > ComentarioService::MAXCOMENTARIOS){
            throw new GenericException("Não é permitido inserir mais que 1 comentarios em 5 segundos");
        }
    }

    /**
     * Metodo salvar o comentario
     */
    public function salvar(Request $request){
        $this->validar($request);

        $valores = $request->only('usuario_id', 'postagem_id', 'comentario');
        $comentario = new Comentario();
        $comentario->fill($valores);
        $comentario->save();
        if($comentario){
            Notificacao::create($request->only('usuario_id', 'postagem_id'));
        }
        return $comentario;
    }

    /**
     * Metodo validar request para inserção de comentarios
     */
    public function comentarioValidator(Request $request) {
        $validator = Validator::make($request->all(), 
            [
                'comentario' => 'required|max:500',
                'usuario_id' => 'required|numeric',
                'postagem_id' => 'required|numeric'
            ],
            [
                'required' => 'O :attribute é obrigatorio.'
            ]
        );

        return $validator;
    }

}
