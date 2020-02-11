<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operadora;

class OperadoraController extends Controller {

    protected $titleModal = 'Operadora de Telefonia';

    public function index() {
        $registros = Operadora::all();
        $title = 'Operadoras de Telefonia';
        return view('telefonia.operadora.index',['registros' => $registros])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('operadora.index');
    }

    public function store(Request $request) {
        try {
            $this->validate($request,['nome'=> 'required',]);

            $registro = new Operadora;
            $registro->nome = $request->nome;

            if($request->has('codigo'))
                $registro->codigo = $request->codigo;

            $registro->save();
            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('operadora.index');
    }

    public function show($id) {
        $registro = Operadora::findOrFail($id);
        $title = 'Detalhes da Operadora de Telefonia';
        return view('telefonia.operadora.show',['registro' => $registro])->withTitle($title)->with('titleModal', $this->titleModal);
    }

    public function edit($id) {
        return redirect()->route('operadora.show', $id);
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,['nome'=> 'required',]);

            $registro = Operadora::findOrFail($id);
            $registro->nome = $request->nome;

            if($request->has('codigo'))
                $registro->codigo = $request->codigo;

            $registro->save();
            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('operadora.show', $id);
    }

    public function destroy($id) {

        try {
            $registro = Operadora::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('operadora.index');
    }
}
