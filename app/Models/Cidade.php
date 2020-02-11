<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model {

    protected $fillable = [
        'nome', 'ddd', 'codigoIbge', 'iName',
        'geoNameId', 'mesorregiao_id', 'estado_id'
    ];

    public function estado() {
        return $this->belongsTo('App\Models\Estado');
    }

    public function mesorregiao() {
        return $this->belongsTo('App\Models\Mesorregiao');
    }

    public function enderecos() {
        return $this->hasMany('App\Models\Endereco');
    }
}
