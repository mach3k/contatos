<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Http\Resources\PessoaResource;
use App\Http\Resources\PessoaCollection;

class ClienteController extends Controller {

    public function index() {
        return new PessoaCollection(Pessoa::with('genero')
        ->with('enderecos')
        ->with('telefones')
        ->get());
    }

    public function show($id) {
        return new PessoaResource(Pessoa::with('genero')
        ->with('enderecos')
        ->with('telefones')
        ->findOrFail($id));
    }

    public function store(Request $request) {

        Pessoa::create($request->all());
    }

    public function update(Request $request, $id) {

        $registro = Pessoa::findOrFail($id);
        $registro->update($request->all());
    }

    public function destroy($id) {

        $registro = Pessoa::findOrFail($id);
        $registro->delete();
    }
}
