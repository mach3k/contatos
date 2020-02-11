<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Imagem;

class ImagemController extends Controller {

    protected $titleModal = 'Imagem';
    private $itemPage = 9;

    public function index() {
        $registros = Imagem::where('juridica', false)
        ->with('empregador')
        ->with('genero')
        ->with('enderecos')
        ->with('telefones')
        ->with('foto')
        ->paginate($this->itemPage);

        $title = 'Pessoas físicas';
        // $paises = Pais::all();
        $estados = Estado::all();

        return view('pessoa.index',[
            'registros' => $registros,
            // 'paises' => $paises,
            'estados' => $estados
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Pessoa::where('juridica', false)
        ->with('empregador')
        ->with('genero')
        ->with('enderecos')
        ->with('telefones')
        ->with('foto')
        ->findOrFail($id);

        $title = 'Detalhes do Contato';
        $estados = Estado::all();

        return view('pessoa.show',[
            'registro' => $registro,
            'estados' => $estados
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('pessoa.index');
    }

    public function edit($id) {
        return redirect()->route('pessoa.show', $id);
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'estado_id' => 'required|numeric',
            ]);

            $registro = new Pessoa;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('pessoa.index');
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'estado_id' => 'required|numeric',
            ]);

            $registro = Pessoa::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('pessoa.show', $id);
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

        return redirect()->route('pessoa.index');
    }
}
