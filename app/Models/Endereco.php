<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cagartner\CorreiosConsulta\CorreiosConsulta;

class Endereco extends Model {

    protected $fillable = [
        'pessoa_id', 'tipo_endereco_id', 'cidade_id',
        'logradouro', 'numero', 'complemento', 'bairro',
        'cep', 'observacao'
    ];

    public function pessoa() {
        return $this->belongsTo('App\Models\Pessoa');
    }

    public function cidade() {
        return $this->belongsTo('App\Models\Cidade');
    }

    public function tipo() {
        return $this->belongsTo('App\Models\TipoEndereco', 'tipo_endereco_id');
    }

    public function cepFormatado() {
        $tamanho = strlen($this->cep);

        if(substr($this->cep, -4, -3) == '-')
            return $this->cep;

        if ($tamanho < 3)
            return trim($this->cep);

        $novo = substr($this->cep, -3);

        if ($tamanho > 3)
            if ($tamanho > 6)
                $novo = substr($this->cep, -6, -3) . '-' . $novo;
            else
                return substr($this->cep, 0, -3) . ' - ' . $novo;

        return substr($this->cep, 0, -6) . '.' . $novo;
    }

    public static function getCep($cep){
        $correios = new CorreiosConsulta;
        return $correios->cep($cep);
    }
}
