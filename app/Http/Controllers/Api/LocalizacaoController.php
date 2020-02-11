<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use App\Models\Regiao;
use App\Models\Estado;
use App\Models\Mesorregiao;
use App\Models\Endereco;

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
        return Pais::with('estados')->findOrFail($id);
    }

    public static function listaEstadosPorRegiao($id) {  // id da região
        return  Regiao::with('estados')->findOrFail($id);
    }

    public function listaMesorregioes($id) {  // id do estado
        return Estado::with('mesorregioes')->findOrFail($id);
    }

    public static function listaCidades($id) {  // id do estado
        return Estado::with('cidades')->findOrFail($id);
    }

    public static function listaCidadesPorMeso($id) {  // id da mesorregião
        return Mesorregiao::with('cidades')->findOrFail($id);
    }
}
