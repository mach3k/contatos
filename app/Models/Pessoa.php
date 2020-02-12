<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model {

    protected $fillable = [
        'nome', 'nomeSocial', 'utilizaNomeSocial', 'genero_id',
        'dataNascimento', 'cpf_cnpj', 'rg_ie',
        'juridica', 'cargo', 'empresa'
    ];

    public function getNome(){

        if ( $this->utilizaNomeSocial)
            return $this->nomeSocial;

        return $this->nome;
    }

    // public function usuario() {
    //     return $this->hasOne('App\Models\User');
    // }

    public function enderecos() {
        return $this->hasMany('App\Models\Endereco');
    }

    public function endereco() {
        return $this->hasOne('App\Models\Endereco')->oldest();
    }

    public function telefones() {
        return $this->hasMany('App\Models\Telefone')->where('excluido','=', 0);
    }

    public function telefone() {
        return $this->hasOne('App\Models\Telefone')->oldest();
    }

    // public function emails() {
    //     return $this->hasMany('App\Models\Email');
    // }

    public function foto() {
        return $this->belongsTo('App\Models\Imagem');
    }

    public function genero() {
        return $this->belongsTo('App\Models\Genero');
    }

    public function empregador() {
        return $this->belongsTo('App\Models\Pessoa', 'empresa');
    }

    public function ehEmpregador() {
        return is_null($this->attributes['empresa']);
    }

    public function empregados() {
        // return $this->hasMany('App\Models\Pessoa');
        return $this->hasMany(Pessoa::class, 'empresa');
    }

    public function cpfFormatado() {
        $tamanho = strlen($this->cpf_cnpj);

        if (substr($this->cpf_cnpj, -3, -2) == '-')
            return $this->cpf_cnpj;

        if ($tamanho <= 2)
            return trim($this->cpf_cnpj);

        $novo = substr($this->cpf_cnpj, -2);

        if ($tamanho <= 5)
            return substr($this->cpf_cnpj, 0, -2) . '-' . $novo;

        $novo = substr($this->cpf_cnpj, -5, -2) . '-' . $novo;

        if ($tamanho <= 8)
            return substr($this->cpf_cnpj, 0, -5) . '.' . $novo;

        return substr($this->cpf_cnpj, 0, -8) . '.' . substr($this->cpf_cnpj, -8, -5) . '.' . $novo;
    }

    public function cnpjFormatado() {
        $tamanho = strlen($this->cpf_cnpj);

        if(substr($this->cpf_cnpj, -7, -6) == '/')
            return $this->cpf_cnpj;

        if ($tamanho <= 2)
            return trim($this->cpf_cnpj);

        $novo = substr($this->cpf_cnpj, -2);

        if ($tamanho <= 6)
            return substr($this->cpf_cnpj, 0, -2) . '-' . $novo;

        $novo = substr($this->cpf_cnpj, -6, -2) . '-' . $novo;

        if ($tamanho <= 9)
            return substr($this->cpf_cnpj, 0, -6) . '/' . $novo;

        $novo = substr($this->cpf_cnpj, -9, -6) . '/' . $novo;

        if ($tamanho <= 12)
            return substr($this->cpf_cnpj, 0, -9) . '.' . $novo;

        return substr($this->cpf_cnpj, 0, -12) . '.' . substr($this->cpf_cnpj, -12, -9) . '.' . $novo;
    }

    public function cpfCnpjFormatado(){

        if (strlen($this->cpf_cnpj) > 11)
            return $this->cnpjFormatado();

        return $this->cpfFormatado();
    }
}
