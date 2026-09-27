<?php

namespace App\Services;

use App\Models\Endereco;
use Illuminate\Support\Facades\Http;

class CepService
{
    public function consultarCep(string $cep)
    {
        $resposta = Http::get(
            "https://viacep.com.br/ws/{$cep}/json/"
        );

        return $resposta->json();
    }

    public function consultarESalvar(string $cep){
        $dados =$this->consultarCep($cep);
        return Endereco::create ([
            'cep'=>$dados['cep'],
            'logradouro' => $dados['logradouro'],
            'bairro'=>$dados['bairro'],
            'localidade'=>$dados['localidade'],
            'uf'=>$dados['uf']
        ]);
    }
}