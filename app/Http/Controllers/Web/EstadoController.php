<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pais;
use App\Models\Regiao;
use App\Models\Estado;

class EstadoController extends Controller {

    protected $titleModal = 'Estado';

    public function index() {
        $registros = Estado::with('pais')->with('regiao')->get();
        $regioes = Regiao::all();
        $paises = Pais::all();
        $title = 'Estados';

        return view('localizacao.estado.index',[
            'registros' => $registros,
            'paises' => $paises,
            'regioes' => $regioes
        ])

        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Estado::with('pais')->with('regiao')->findOrFail($id);
        $regioes = Regiao::all();
        $paises = Pais::all();
        $title = 'Detalhes do Estado';

        return view('localizacao.estado.show',[
            'registro' => $registro,
            'paises' => $paises,
            'regioes' => $regioes
        ])->withTitle($title)->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('estado.index');
    }

    public function edit($id) {
        return redirect()->route('estado.show', $id);
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'sigla' => 'required|max:2',
                'pais_id' => 'required|numeric',
            ]);

            $registro = new Estado;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('estado.index');
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'sigla' => 'required|max:2',
                'pais_id' => 'required|numeric',
            ]);

            $registro = Estado::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('estado.show', $id);
    }

    protected function salvar(Request $request, Estado $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {

        try {
            $registro = Estado::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('estado.index');
    }
}
