<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operadora extends Model {

    public function telefones() {
        return $this->hasMany('App\Models\Telefone');
    }
}
