<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoEndereco;

class TipoEnderecoController extends Controller {

    protected $titleModal = 'Tipo de Endereço';

    public function index() {
        $registros = TipoEndereco::all();
        $title = 'Tipos de Endereço';
        return view('localizacao.tipoendereco.index',['registros' => $registros])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('tipoendereco.index');
    }

    public function store(Request $request) {
        try {
            $this->validate($request,['nome'=> 'required',]);

            $registro = new TipoEndereco;
            $registro->nome = $request->nome;

            if($request->has('descricao'))
                $registro->descricao = $request->descricao;

            $registro->save();
            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('tipoendereco.index');
    }

    public function show($id) {
        $registro = TipoEndereco::findOrFail($id);
        $title = 'Detalhes do tipo de endereco';
        return view('localizacao.tipoendereco.show',['registro' => $registro])->withTitle($title)->with('titleModal', $this->titleModal);
    }

    public function edit($id) {
        return redirect()->route('tipoendereco.show', $id);
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,['nome'=> 'required',]);

            $registro = TipoEndereco::findOrFail($id);
            $registro->nome = $request->nome;

            if($request->has('descricao'))
                $registro->descricao = $request->descricao;

            $registro->save();
            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('tipoendereco.show', $id);
    }

    public function destroy($id) {

        try {
            $registro = TipoEndereco::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('tipoendereco.index');
    }
}
