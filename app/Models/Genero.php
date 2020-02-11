<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model {

    public function pessoas() {
        return $this->hasMany('App\Models\Pessoa');
    }
}
