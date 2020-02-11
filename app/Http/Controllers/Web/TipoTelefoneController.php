<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoTelefone;

class TipoTelefoneController extends Controller {

    protected $titleModal = 'Tipo de Telefone';

    public function index() {
        $registros = TipoTelefone::all();
        $title = 'Tipos de Telefone';
        return view('telefonia.tipotelefone.index',['registros' => $registros])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('tipotelefone.index');
    }

    public function store(Request $request) {
        try {
            $this->validate($request,['nome'=> 'required',]);

            $registro = new TipoTelefone;
            $registro->nome = $request->nome;

            if($request->has('descricao'))
                $registro->descricao = $request->descricao;

            $registro->save();
            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('tipotelefone.index');
    }

    public function show($id) {
        $registro = TipoTelefone::findOrFail($id);
        $title = 'Detalhes do tipo de telefone';
        return view('telefonia.tipotelefone.show',['registro' => $registro])->withTitle($title)->with('titleModal', $this->titleModal);
    }

    public function edit($id) {
        return redirect()->route('tipotelefone.show', $id);
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,['nome'=> 'required',]);

            $registro = TipoTelefone::findOrFail($id);
            $registro->nome = $request->nome;

            if($request->has('descricao'))
                $registro->descricao = $request->descricao;

            $registro->save();
            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('tipotelefone.show', $id);
    }

    public function destroy($id) {

        try {
            $registro = TipoTelefone::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('tipotelefone.index');
    }
}
