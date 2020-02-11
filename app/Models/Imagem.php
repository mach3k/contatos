<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model {

    protected $table = 'imagens';

    public function pessoa() {
        return $this->hasOne('App\Models\Pessoa');
    }

    public function pais() {
        return $this->hasOne('App\Models\Pais');
    }
}
