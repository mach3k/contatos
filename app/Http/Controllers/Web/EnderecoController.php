<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Endereco;

class EnderecoController extends Controller {

    public function index() {
        return redirect()->route('pessoa.index');
    }

    public function show($id) {
        return redirect()->route('pessoa.index');
    }

    public function create() {
        return redirect()->route('pessoa.index');
    }

    public function edit($id) {
        return redirect()->route('pessoa.index');
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'logradouro'=> 'required|max:200',
                'pessoa_id' => 'required|numeric',
                'cidade_id' => 'required|numeric',
            ]);

            $registro = new Endereco;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,[
                'logradouro'=> 'required|max:200',
                'pessoa_id' => 'required|numeric',
                'cidade_id' => 'required|numeric',
            ]);

            $registro = Endereco::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('pessoa.show', $id);
    }

    protected function salvar(Request $request, Endereco $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {
        $idPessoa = 0;
        $juridica = false;

        try {
            $registro = Endereco::findOrFail($id);
            $idPessoa = $registro->pessoa->id;
            $juridica = $registro->pessoa->juridica;
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        if ($juridica)
            return redirect()->route('empresa.show', $idPessoa);

        return redirect()->route('pessoa.show', $idPessoa);
    }
}
