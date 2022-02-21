<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeralController extends Controller
{
    public function cepBusca(Request $request)
    {
        $cep = Http::get('https://viacep.com.br/ws/'.$request->cep.'/json')->object();
        return response()->json($cep);
    }

    public function solicitacoes()
    {
        return view('solicitacoes');
    }

    public function solicitacoesUpdate(Request $request)
    {
        # code...
    }

    public function novaSolicitacao()
    {
        return view('novaSolicitacao');
    }

    public function novaSolicitacaoPost(Request $request)
    {
        # code...
    }

    public function editarSolicitacao()
    {
        # code...
    }

    public function editarSolicitacaoPost(Request $request)
    {
        # code...
    }

    public function lojista()
    {
        return view('lojista');
    }

    public function lojistaPost(Request $request)
    {
        # code...
    }

    public function cliente()
    {
        return view('cliente');
    }

    public function clientePost(Request $request)
    {
        # code...
    }

    public function veiculo()
    {
        return view('veiculo');
    }

    public function veiculoPost(Request $request)
    {
        # code...
    }
}
