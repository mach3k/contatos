<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesorregiao extends Model {

    protected $table = 'mesorregioes';

    protected $fillable = [
        'nome', 'codigoIbge', 'iName', 'geoNameId', 'estado_id'
    ];

    public function estado() {
        return $this->belongsTo('App\Models\Estado');
    }

    public function cidades() {
        return $this->hasMany('App\Models\Cidade');
    }
}
