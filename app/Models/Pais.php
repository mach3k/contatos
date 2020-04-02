<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model {

    protected $table = 'paises';

    protected $fillable = [
        'nome', 'sigla', 'ddi', 'iName', 'geoNameId',
    ];

    public function regioes() {
        return $this->hasMany('App\Models\Regiao');
    }

    public function estados() {
        return $this->hasMany('App\Models\Estado');
    }

    public function bandeira() {
        return $this->belongsTo('App\Models\Imagem');
    }
}
