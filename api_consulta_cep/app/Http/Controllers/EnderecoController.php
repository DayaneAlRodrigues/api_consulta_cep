<?php

namespace App\Http\Controllers;

use App\Services\CepService;
use Illuminate\Http\Request;
use App\Models\Endereco;

class EnderecoController extends Controller
{
     public function __construct(
        private CepService $cepService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enderecos = Endereco::all();
        return response()->json($enderecos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'cep'=>'required|string'
        ]);


        $cep = $this->cepService->consultarESalvar($dados['cep']);
        return response()->json($cep,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $cep)
    {
        $endereco = Endereco::where('cep',$cep)->first();
        if($endereco){
            return response()->json($endereco,200);
        }
        $endereco = $this->cepService->consultarESalvar($cep);
        return response()->json($endereco,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Endereco $endereco)
    {
        $dados = $request->validate([
            'cep'=>'required|string'
        ]);

        $enderecoAtualizado = $this->cepService->consultarCep($dados['cep']);

        if(isset($enderecoAtualizado['erro'])&& $enderecoAtualizado['erro'] ===true){
            return response()->json([
            'message' => 'CEP não encontrado na ViaCEP.'
                ], 404);
        }

        $endereco->update([
            'cep' => $enderecoAtualizado['cep'],
            'logradouro'=>$enderecoAtualizado['logradouro'],
            'bairro'=>$enderecoAtualizado['bairro'],
            'localidade'=>$enderecoAtualizado['localidade'],
            'uf'=>$enderecoAtualizado['uf']
        ]);

        return response()->json($endereco);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Endereco $endereco)
    {
        $endereco->delete();
        return response()->json([
            'message'=>'Endereco excluido'
        ]);
    }
}
