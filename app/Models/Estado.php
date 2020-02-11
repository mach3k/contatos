<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model {

    protected $fillable = [
        'nome', 'sigla', 'codigoIbge',
        'iName', 'geoNameId', 'pais_id', 'regiao_id'
    ];

    public function pais() {
        return $this->belongsTo('App\Models\Pais');
    }

    public function cidades() {
        return $this->hasMany('App\Models\Cidade');
    }

    public function mesorregioes() {
        return $this->hasMany('App\Models\Mesorregiao');
    }

    public function regiao() {
        return $this->belongsTo('App\Models\Regiao');
    }
}
