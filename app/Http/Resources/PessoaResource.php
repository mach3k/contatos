<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\GeneroResource;

class PessoaResource extends JsonResource {

    public function toArray($request) {

        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'nomeSocial' => $this->nomeSocial,
            'utilizaNomeSocial' => $this->utilizaNomeSocial,
            'dataNascimento' => $this->dataNascimento,
            'cpf_cnpj' => $this->cpf_cnpj,
            'rg_ie' => $this->rg_ie,
            'juridica' => $this->juridica,
            'enderecos' => EnderecoResource::collection($this->enderecos),
            'telefones' => TelefoneResource::collection($this->telefones),
            'genero' => new GeneroResource($this->genero),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];
    }
}
