<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pais;

class PaisController extends Controller {

    protected $titleModal = 'País';

    public function index() {
        $registros = Pais::all();
        $title = 'Países';
        return view('localizacao.pais.index',['registros' => $registros])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Pais::findOrFail($id);
        $title = 'Detalhes do País';
        return view('localizacao.pais.show',['registro' => $registro])->withTitle($title)->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('pais.index');
    }

    public function edit($id) {
        return redirect()->route('pais.show', $id);
    }

    public function store(Request $request) {
        try {
            $this->validate($request,['nome'=> 'required',]);

            $registro = new Pais;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('pais.index');
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,['nome'=> 'required',]);

            $registro = Pais::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('pais.show', $id);
    }

    protected function salvar(Request $request, Pais $registro){

        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {

        try {
            $registro = Pais::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('pais.index');
    }
}
