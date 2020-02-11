<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pais;
use App\Models\Estado;
use App\Models\Cidade;

class CidadeController extends Controller {

    protected $titleModal = 'Cidade';

    public function index() {
        $registros = Cidade::with(['estado', 'mesorregiao'])->paginate();
        $paises = Pais::all();
        $estados = Estado::all();
        $title = 'Cidades';

        return view('localizacao.cidade.index',[
            'registros' => $registros,
            'paises' => $paises,
            'estados' => $estados
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Cidade::with('estado')->with('mesorregiao')->findOrFail($id);
        // $paises = Pais::all();
        // $estados = Estado::all();
        $title = 'Detalhes da Cidade';

        return view('localizacao.cidade.show',[
            'registro' => $registro
            // 'paises' => $paises,
            // 'estados' => $estados
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('cidade.index');
    }

    public function edit($id) {
        return redirect()->route('cidade.show', $id);
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'estado_id' => 'required|numeric',
            ]);

            $registro = new Cidade;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('cidade.index');
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'estado_id' => 'required|numeric',
            ]);

            $registro = Cidade::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('cidade.show', $id);
    }

    protected function salvar(Request $request, Cidade $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {

        try {
            $registro = Cidade::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('cidade.index');
    }
}
