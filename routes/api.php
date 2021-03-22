<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/', function () {
//     return response()->json(['message' => 'API Comentarios', 'status' => 'Conectado']);;
// });

Route::post('comentarios', 'ComentariosController@salvar');
Route::get('postagens/{postagem_id}/comentarios', 'PostagensController@listaComentario');
Route::get('usuarios/{usuario_id}/notificacoes', 'UsuariosController@listaNotificacoes');

