<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Telefone;
use App\Models\TipoTelefone;
use App\Models\Operadora;

class PessoaController extends Controller {

    public function enderecos($id){
        $registro = Pessoa::findOrFail($id);
        // dd(Pessoa::with('enderecos')->findOrFail($id));
        // return Pessoa::with('enderecos')->findOrFail($id);
        return $registro->enderecos()->with(['tipo', 'cidade', 'cidade.estado', 'cidade.estado.pais'])->get();
    }

    public function cpfFormatado($id){
        $registro = Pessoa::findOrFail($id);
        // dd(Pessoa::with('enderecos')->findOrFail($id));
        // return Pessoa::with('enderecos')->findOrFail($id);
        return $registro->cpfFormatado();
    }

    public function telefones($id){
        $registro = Pessoa::findOrFail($id);
        return $registro->telefones()->with(['tipo', 'operadora'])->get();
    }

    public function numeroFormatado($idTelefone){
        $registro = Telefone::findOrFail($idTelefone);
        return $registro->numeroFormatado();
    }

    public function listaTiposTelefone(){
        return TipoTelefone::all();
    }

    public function listaOperadoras(){
        return Operadora::all();
    }

    public function salvarTelefone(Request $request){
        // dd($request);

        try {
            $this->validate($request,[
                'numero'=> 'required|max:15',
                'pessoa_id' => 'required|numeric',
            ]);

            $registro = null;

            if($request->filled('id')){
                $registro = Telefone::findOrFail($request->input('id'));
            } else{
                $registro = new Telefone;
            }

            $novo = $this->salvar($request, $registro);
            return $novo->load(['tipo', 'operadora']);

            // return true;
            // toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
            return $th;
        }

        // return $request->all();
    }

    protected function salvar(Request $request, Telefone $registro){
        $registro->fill($request->all());
        $registro->save();

        return $registro;
    }

    public function excluirTelefone($id){
        
        try {
            $registro = Telefone::findOrFail($id);
            $registro->delete();
            return ['Registro excluído com sucesso!', 'Feito!', 'success'];
        } catch (\Throwable $th) {
            return ['Falha ao excluir o registro.', 'Ops!', 'danger'];
        }
    }
}
