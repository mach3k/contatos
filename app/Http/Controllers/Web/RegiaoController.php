<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pais;
use App\Models\Regiao;

class RegiaoController extends Controller {

    protected $titleModal = 'Região';

    public function index() {
        $registros = Regiao::with('pais')->get();
        $paises = Pais::all();
        $title = 'Regiões';
        return view('localizacao.regiao.index',['registros' => $registros, 'paises' => $paises])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Regiao::with('pais')->findOrFail($id);
        $paises = Pais::all();
        $title = 'Detalhes da Região';
        return view('localizacao.regiao.show',['registro' => $registro, 'paises' => $paises])->withTitle($title)->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('regiao.index');
    }

    public function edit($id) {
        return redirect()->route('regiao.show', $id);
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'nome'=> 'required|max:100',
                'sigla' => 'required|max:2',
                'pais_id' => 'required|numeric',
            ]);

            $registro = new Regiao;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('regiao.index');
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,[
                'nome'=> 'required|max:100',
                'sigla' => 'required|max:2',
                'pais_id' => 'required|numeric',
            ]);

            $registro = Regiao::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('regiao.show', $id);
    }

    protected function salvar(Request $request, Regiao $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {

        try {
            $registro = Regiao::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('regiao.index');
    }
}
