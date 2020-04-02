<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cidade;
use App\Models\Pais;
use App\Models\Regiao;
use App\Models\Estado;
use App\Models\Mesorregiao;
use App\Models\Endereco;
use App\Models\TipoEndereco;
use GuzzleHttp\Client;

class LocalizacaoController extends Controller {

    public function getCep($cep) {
        return Endereco::getCep($cep);
    }

    public static function listaPaises() {
        return Pais::all();
    }

    public static function listaRegioes($id) {  // id do país
        return Pais::with('regioes')->findOrFail($id);
    }

    public static function listaEstados($id) {  // id do país
        // return Pais::with('estados')->findOrFail($id);
        // $registro = Pais::with('estados')->findOrFail($id);
        // return $registro->estados;

        // return Estado::where('pais_id', '=', $id)->get();

        $registros = Estado::where('pais_id', '=', $id)->get();

        if ($registros->count() > 0)
            return $registros;

        $pais = Pais::findOrFail($id);
        $client = new Client();
        // $response = $client->request('GET', 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' . $pais->codigoIbge . '/mesorregioes');
        $response = $client->request('GET', 'http://api.geonames.org/childrenJSON?geonameId=' . $pais->geoNameId . '&username=mrmachado');
        // $response = $client->request('GET', 'http://api.geonames.org/childrenJSON?geonameId=3439705&username=mrmachado');
        // dd($response->getBody());
        // return json_decode((string) $response->getBody(), true);
        $items = json_decode((string) $response->getBody(), true);
        // dd($items);

        // $newItems = array_map(function($item){
        return array_map(function($item){
            // dd($item);
            return (object)['id' => $item['geonameId'], 'nome' => $item['name']];
        }, $items['geonames']);

        // dd($newItems);
    }

    public static function listaEstadosPorRegiao($id) {  // id da região
        return  Regiao::with('estados')->findOrFail($id);
    }

    public function listaMesorregioes($id, $pais) {  // id do estado
        return Estado::with('mesorregioes')->findOrFail($id);
    }

    public static function listaCidades($id, $pais) {  // id do estado
        // return Estado::with('cidades')->findOrFail($id);
        // $registro = Estado::with('cidades')->findOrFail($id);
        // return $registro->cidades;

        // return Cidade::where('estado_id', '=', $id)->get();

        if($pais == 1)
            return Cidade::where('estado_id', '=', $id)->get();

        // $estado = Estado::findOrFail($id);
        $client = new Client();
        // $response = $client->request('GET', 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' . $pais->codigoIbge . '/mesorregioes');
        $response = $client->request('GET', 'http://api.geonames.org/childrenJSON?geonameId=' . $id . '&username=mrmachado');
        // dd($response->getBody());
        // return json_decode((string) $response->getBody(), true);
        $items = json_decode((string) $response->getBody(), true);
        // dd($items);

        // $newItems = array_map(function($item){
        return array_map(function($item){
            // dd($item);
            return (object)['id' => $item['geonameId'], 'nome' => $item['name']];
        }, $items['geonames']);

        // dd($newItems);
    }

    public static function listaCidadesPorMeso($id) {  // id da mesorregião
        return Mesorregiao::with('cidades')->findOrFail($id);
    }

    public function listaTiposEnderecos(){
        return TipoEndereco::all();
    }

    public function cepFormatado($idEndereco) {

        $registro = Endereco::findOrFail($idEndereco);

        $tamanho = strlen($registro->cep);

        if(substr($registro->cep, -4, -3) == '-')
            return $registro->cep;

        if ($tamanho < 3)
            return trim($registro->cep);

        $novo = substr($registro->cep, -3);

        if ($tamanho > 3)
            if ($tamanho > 6)
                $novo = substr($registro->cep, -6, -3) . '-' . $novo;
            else
                return substr($registro->cep, 0, -3) . ' - ' . $novo;

        return substr($registro->cep, 0, -6) . '.' . $novo;
    }

    public function getCidadePeloNome($nomeCidade){
        // $registro = Cidade::where('nome', 'like', $nomeCidade)->with(['estado', 'estado.pais'])->first();
        // dd($registro);
        return Cidade::where('nome', 'like', $nomeCidade)->with(['estado', 'estado.pais'])->first();
    }

    public function salvarEndereco(Request $request){
        // dd($request);

        try {
            $this->validate($request,[
                'logradouro'=> 'required|max:200',
                'pessoa_id' => 'required|numeric',
                // 'cidade_id' => 'required|numeric',
            ]);

            $cidade = null;
            if($request->filled('cidade_id')){
                $pais = Pais::findOrFail($request->input('pais_id'));

                if($pais->id > 1){
                    $estado = Estado::firstOrCreate(
                        ['geoNameId' => $request->input('estado_id')],
                        [
                            'nome' => $request->input('estado_nome'),
                            'pais_id' => $pais->id,
                            'sigla' => ' ',
                            'iName' => $request->input('estado_nome')
                        ]
                    );

                    $cidade = Cidade::firstOrCreate(
                        ['geoNameId' => $request->input('cidade_id')],
                        [
                            'estado_id' => $estado->id,
                            'nome' => $request->input('cidade_nome'),
                            'iName' => $request->input('cidade_nome')
                        ]
                    );
                } else {
                    $cidade = Cidade::findOrFail($request->input('cidade_id'));
                }
            }

            $registro = null;

            if($request->filled('id')){
                $registro = Endereco::findOrFail($request->input('id'));
            } else{
                $registro = new Endereco;
            }

            // return $registro->load(['tipo', 'cidade', 'cidade.estado', 'cidade.estado.pais']);

            // $registro-> = 

            $novo = $this->salvar($request, $registro, $cidade->id);
            return $novo->load(['tipo', 'cidade', 'cidade.estado', 'cidade.estado.pais']);

            // return true;
            // toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
            return $th;
        }

        // return $request->all();
    }

    protected function salvar(Request $request, Endereco $registro, $cidade){
        $registro->fill($request->all());
        $registro->cidade_id = $cidade;
        $registro->save();

        return $registro;
    }

    public function excluirEndereco($id){
        
        try {
            $registro = Endereco::findOrFail($id);
            $registro->delete();
            return ['Registro excluído com sucesso!', 'Feito!', 'success'];
        } catch (\Throwable $th) {
            return ['Falha ao excluir o registro.', 'Ops!', 'danger'];
        }
    }
}
