<?php

use App\Models\User;
use App\Models\Conteudo;
use App\Models\Comentario;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConteudoController;


Route::post('/cadastro', [UsuarioController::class, 'cadastro']);
Route::post('/login', [UsuarioController::class, 'login']);
//Route::middleware('auth:api')->get('/usuario', [UsuarioController::class, 'usuario']);
Route::middleware('auth:api')->put('/perfil', [UsuarioController::class, 'perfil']);

Route::middleware('auth:api')->post('/conteudo/adicionar', [ConteudoController::class, 'adicionar']);
Route::middleware('auth:api')->get('/conteudo/listar', [ConteudoController::class, 'listar']);
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', [ConteudoController::class, 'curtir']);

//Route::get('/testes', [ConteudoController::class, 'testes']);
