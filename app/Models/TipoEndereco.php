<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEndereco extends Model {

    protected $table = 'tipos_endereco';
    protected $fillable = ['nome', 'descricao',];

    public function enderecos() {
        return $this->hasMany('App\Models\Endereco', 'tipo_endereco_id');
    }
}
