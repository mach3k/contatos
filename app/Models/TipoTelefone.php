<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTelefone extends Model {

    protected $table = 'tipos_telefone';

    public function telefones() {
        return $this->hasMany('App\Models\Telefone', 'tipo_telefone_id');
    }
}
