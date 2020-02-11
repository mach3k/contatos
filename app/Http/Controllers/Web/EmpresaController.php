<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Estado;
use App\Models\TipoTelefone;
use App\Models\Operadora;
use App\Models\TipoEndereco;

class EmpresaController extends Controller {

    protected $titleModal = 'Empresa';
    private $itemPage = 9;

    public function index() {
        $registros = Pessoa::where('juridica', true)
        ->with('endereco')
        ->with('telefone')
        // ->paginate($this->itemPage);
        ->get();

        $title = 'Empresas';
        // $paises = Pais::all();    // geolocalização mundial disponível apenas após a contratação
        $estados = Estado::all();

        $tipos = TipoTelefone::all();
        $operadoras = Operadora::all();

        return view('empresa.index',[
            'registros' => $registros,
            // 'paises' => $paises,
            'estados' => $estados,
            'tipos' => $tipos,
            'operadoras' => $operadoras
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Pessoa::with('empregados')
        ->with('genero')
        ->with('enderecos')
        ->with('enderecos.tipo')
        ->with('telefones')
        ->with('telefones.tipo')
        ->with('foto')
        ->findOrFail($id);

        $title = 'Detalhes da Empresa';

        $tipos = TipoTelefone::all();
        $tiposEnd = TipoEndereco::all();
        $operadoras = Operadora::all();

        return view('empresa.show',[
            'registro' => $registro,
            'tipos' => $tipos,
            'tiposEnd' => $tiposEnd,
            'operadoras' => $operadoras
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('empresa.index');
    }

    public function edit($id) {
        return redirect()->route('empresa.show', $id);
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'nome'=> 'required|max:200'
            ]);

            $registro = new Pessoa;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('empresa.index');
    }

    public function update(Request $request, $id) {

        dd($request);

        try {
            $this->validate($request,[
                'nome'=> 'required|max:200'
            ]);

            $registro = Pessoa::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('empresa.show', $id);
    }

    protected function salvar(Request $request, Pessoa $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {

        try {
            $registro = Pessoa::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('empresa.index');
    }
}
