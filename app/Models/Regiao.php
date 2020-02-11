<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model {

    protected $table = 'regioes';
    protected $fillable = [
        'nome', 'sigla', 'codigoIbge', 'iName', 'geoNameId', 'pais_id'
    ];

    public function pais() {
        return $this->belongsTo('App\Models\Pais');
    }

    public function estados() {
        return $this->hasMany('App\Models\Estado');
    }
}
