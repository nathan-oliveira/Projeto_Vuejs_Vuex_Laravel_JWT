<?php
namespace App\Models;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conteudo;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class ConteudoController extends Controller
{
    public function listar(Request $request) {
        $conteudos = Conteudo::with('User')->orderBy('data', 'DESC')->paginate(5);
        $user = $request->user();

        foreach ($conteudos as $key => $conteudo) {
            $conteudo->total_curtidas = $conteudo->curtidas()->count();
            $curtiu = $user->curtidas()->find($conteudo->id);

            if($curtiu) {
                $conteudo->curtiu_conteudo = true;
            } else {
                $conteudo->curtiu_conteudo = false;
            }
        }

        return ['status' => true, 'conteudos' => $conteudos];
    }

    public function adicionar(Request $request) {
        $data = $request->all();
        $user = $request->user();

        // validação
        $validacao = Validator::make($data, [
            'titulo' => 'required',
            'texto' => 'required',
        ]);

        if($validacao->fails()) :
            return [
                'status' => false,
                'validacao' => true,
                'errors' => $validacao->errors()
            ];
        endif;

        $conteudo = new Conteudo;

        $conteudo->titulo = $data['titulo'];
        $conteudo->texto = $data['texto'];
        $conteudo->link = $data['link'] ? $data['link'] : '#';
        $conteudo->imagem = $data['imagem'] ? $data['imagem'] : '#';
        $conteudo->data = date('Y-m-d H:i:s');

        $user->conteudos()->save($conteudo);

        $conteudos = Conteudo::with('User')->orderBy('data', 'DESC')->paginate(5);

        return ['status' => true, 'conteudos' => $conteudos];
    }

    public function curtir($id, Request $request) {
        $conteudo = Conteudo::find($id);
        if($conteudo) {
            $user = $request->user();
            $user->curtidas()->toggle($conteudo->id);

            //return $conteudo->curtidas;

            return [
                'status' => true,
                'curtidas' => $conteudo->curtidas()->count(),
                'lista' => $this->listar($request)
            ];
        } else {
            return ['status' => false, 'errors' => 'Conteúdo não existe'];
        }
    }

    /*
    public function testes(Request $request) {
        $conteudo = Conteudo::all();
        foreach ($conteudo as $key => $value) {
            $value->delete();
        }
    }
    */
}
