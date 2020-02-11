<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model {

    protected $fillable = [
        'numero', 'ddd', 'ramal', 'observacao',
        'excluido', 'pessoa_id', 'tipo_telefone_id', 'operadora_id'
    ];

    public function pessoa() {
        return $this->belongsTo('App\Models\Pessoa');
    }

    public function tipo() {
        return $this->belongsTo('App\Models\TipoTelefone', 'tipo_telefone_id');
    }

    public function operadora() {
        return $this->belongsTo('App\Models\Operadora');
    }

    public function numeroFormatado() {
        $tamanho = strlen($this->numero);

        if ($tamanho < 4)
            return trim($this->numero);

        $novo = substr($this->numero, -4);

        if ($tamanho > 4)
            if ($tamanho > 8)
                $novo = substr($this->numero, -8, -4) . '.' . $novo;
            else
                return substr($this->numero, 0, -4) . '.' . $novo;

        return substr($this->numero, 0, -8) . '.' . $novo;
    }

    public function numeroFormatadoComDDD(){
        $ddd = $this->ddd;

        if (!is_null($ddd) && !empty($ddd) && strlen($ddd) > 1)
            return '(' . $ddd . ') ' . $this->numeroFormatado();
    }
}
