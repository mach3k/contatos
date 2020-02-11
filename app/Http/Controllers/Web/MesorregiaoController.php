<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pais;
use App\Models\Estado;
use App\Models\Mesorregiao;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class MesorregiaoController extends Controller {

    protected $titleModal = 'Mesorregião';

    public function index() {

        $registros = Mesorregiao::with('estado')->get();
        $paises = Pais::all();
        $estados = Estado::all();
        $title = 'Mesorregiões';

        return view('localizacao.mesorregiao.index',[
            'registros' => $registros,
            'paises' => $paises,
            'estados' => $estados
        ])

        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Mesorregiao::with('estado')->findOrFail($id);
        $paises = Pais::all();
        $estados = Estado::all();
        $title = 'Detalhes da Mesorregião';

        return view('localizacao.mesorregiao.show',[
            'registro' => $registro,
            'paises' => $paises,
            'estados' => $estados
        ])->withTitle($title)->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('mesorregiao.index');
    }

    public function edit($id) {
        return redirect()->route('mesorregiao.show', $id);
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'estado_id' => 'required|numeric',
            ]);

            $registro = new Mesorregiao;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('mesorregiao.index');
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'estado_id' => 'required|numeric',
            ]);

            $registro = Mesorregiao::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('mesorregiao.show', $id);
    }

    protected function salvar(Request $request, Mesorregiao $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {

        try {
            $registro = Mesorregiao::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('mesorregiao.index');
    }

    public function loadByEstado(Request $request){

        try {
            $registros = DB::table('mesorregioes')->where('estado_id', $request->id)->get();
            $output = '<option data-select2-id="" value="">Selecione a mesorregião...</option>';

            $selecionado = 0;
            if ($request->has('selecionado')) {
                toastr()->error('Selecionado...: ' . $request->selecionado);
                $selecionado = $request->selecionado;
            }

            foreach ($registros as $registro) {
                if ($selecionado == $registro->id) {
                    $output .= '<option selected data-select2-id="' . $registro->id . '" value="' . $registro->id . '">' . $registro->nome . '</option>';
                }else{
                    $output .= '<option data-select2-id="' . $registro->id . '" value="' . $registro->id . '">' . $registro->nome . '</option>';
                }
            }

            return $output;
        } catch (\Throwable $th) {
            toastr()->error('Deu ruim...');
            return "Falha ao consultar o banco de dados...";
        }
    }
}
