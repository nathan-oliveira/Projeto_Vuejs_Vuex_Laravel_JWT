<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function login(Request $request) {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if($validacao->fails()) :
            return [
                'status' => false,
                'validacao' => true,
                'errors' => $validacao->errors()
            ];
        endif;

        if(Auth::attempt(['email'=> $data['email'], 'password' => $data['password']])) :
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            //$user->imagem = asset($user->imagem);
            return ['status' => true, 'usuario' => $user];
        else :
            return ['status' => false];
        endif;
    }

    public function cadastro(Request $request) {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validacao->fails()) :
            return [
                'status' => false,
                'validacao' => true,
                'errors' => $validacao->errors()
            ];
        endif;

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, 'usuario' => $user];
    }
/*
    public function usuario(Request $request) {
        return $request->user();
    }
*/
    public function perfil(Request $request) {
        $user = $request->user();
        $data = $request->all();

        if(isset($data['password'])):
            $validacao = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'password' => 'required|string|min:6|confirmed',
            ]);

            if($validacao->fails()) :
                return [
                    'status' => false,
                    'validacao' => true,
                    'errors' => $validacao->errors()
                ];
            endif;

            $user->password = bcrypt($data['password']);
        else:
            $validacao = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            ]);

            if($validacao->fails()) :
                return [
                    'status' => false,
                    'validacao' => true,
                    'errors' => $validacao->errors()
                ];
            endif;

            $user->name = $data['name'];
            $user->email = $data['email'];
        endif;

        if(isset($data['imagem'])):

            Validator::extends('base64image', function($attribute, $value, $parameters, $validator) {
                $explode = explode(',', $value);
                $allow = ['png', 'jpg', 'svg'. 'jpeg'];
                $format = str_replace(
                    [
                        'data:image/',
                        ';',
                        'base64',
                    ],
                    [
                        '', '', '',
                    ],
                    $explode[0]
                );

                if(!in_array($format, $allow)):
                    return false;
                endif;

                if(!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])):
                    return false;
                endif;

                return true;
            });

            $validacao = Validator::make($data,
                [
                    'imagem' => 'base64image',
                ],
                [
                    'base64image' => 'Imagem inválida'
                ]
            );

            if($validacao->fails()) :
                return [
                    'status' => false,
                    'validacao' => true,
                    'errors' => $validacao->errors()
                ];
            endif;

            $time = time();
            $diretorioPai = 'perfils';
            $diretorioImagem = $diretorioPai.DIRECTORY_SEPARATOR.'perfil_id'.$user->id;

            $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') - 11);
            $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$time.'.'.$ext;

            $file = str_replace('data:image/'.$ext.';base64,', '', $data['imagem']);
            $file = base64_decode($file);

            if(!file_exists($diretorioPai)):
                mkdir($diretorioPai, 0700);
            endif;

            if($user->imagem):
                $imgUser = str_replace(asset('/'), '', $user->imagem);
                if(file_exists($diretorioPai)):
                    unlink($imgUser);
                endif;
            endif;

            if(!file_exists($diretorioImagem)):
                mkdir($diretorioImagem, 0700);
            endif;

            file_put_contents($urlImagem, $file);

            $user->imagem = $urlImagem;

        endif;

        $user->save();

        //$user->imagem = asset($user->imagem);
        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, 'usuario' => $user];
    }
}
