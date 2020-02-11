<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Telefone;
use App\Models\Pessoa;

class TelefoneController extends Controller {

    public function index() {
        $registros = Telefone::with('pessoa')
        ->with('tipo')
        ->with('operadora')
        ->get();

        $title = 'Lista Telefônica';

        return view('telefonia.listatelefonica.index',['registros' => $registros])->withTitle($title);
    }

    public function show($id) {
        $registro = Pessoa::whereHas('telefones', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->get()->first();

        // dd($registro);

        if ($registro->juridica) {
            return redirect()->route('empresa.show', $registro->id);
        }

        return redirect()->route('pessoa.show', $registro->id);
    }

    public function create() {
        return redirect()->route('telefonia.listatelefonica.index');
    }

    public function edit($id) {
        return redirect()->route('telefonia.listatelefonica.index');
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'numero'=> 'required|max:15'
            ]);

            $registro = new Telefone;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id) {

        // dd($request);

        try {
            $this->validate($request,[
                'numero'=> 'required|max:15'
            ]);

            $registro = Telefone::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('telefonia.listatelefonica.show', $id);
    }

    protected function salvar(Request $request, Telefone $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {
        $idPessoa = 0;
        $juridica = false;

        try {
            $registro = Telefone::findOrFail($id);
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
