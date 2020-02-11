@extends('adminlte::page')

@section('title')
{{$title}}
@endsection

@section('content_header')
<!-- Content Header (Page header) -->

  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{$title}}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
            <li class="breadcrumb-item"><a href="{{route('pessoa.index')}}">{{$titleModal}}</a></li>
            <li class="breadcrumb-item active">{{$registro->nome}}</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Registro</h3>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar">Editar registro</button>
                </div>
            </div><!-- /.card-header -->

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <img class="img-fluid pad" src="{{asset('storage/images/sem_foto.png')}}" alt="Photo">
                    </div>

                    <div class="col-sm-4">
                        <dl>
                            <dt>Nome</dt>
                            <dd>{{$registro->nome}}</dd>

                            <dt>Nome Social</dt>
                            <dd>{{$registro->nomeSocial}}@if($registro->utilizaNomeSocial) (utiliza nome social)@endisset</dd>

                            <dt>Data de nascimento</dt>
                            <dd>{{ \Carbon\Carbon::parse($registro->dataNascimento)->format('d/m/Y') }}</dd>

                            <dt>Sexo</dt>
                            @if(isset($registro->genero))
                                <dd>{{$registro->genero->nome}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif
                        </dl>
                        </div>

                        <div class="col-sm-4">
                            <dl>
                            <dt>Empresa</dt>
                            @if(isset($registro->empregador))
                                <dd>{{$registro->empregador->nome}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif

                            <dt>Cargo</dt>
                            @if(isset($registro->cargo))
                                <dd>{{$registro->cargo}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif

                            <dt>CPF</dt>
                            @if(isset($registro->cpf_cnpj))
                                <dd>{{$registro->cpfFormatado()}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif

                            <dt>RG</dt>
                            @if(isset($registro->rg_ie))
                                <dd>{{$registro->rg_ie}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif
                        </dl>
                    </div>
                </div>

                <div class="row">
                    <div class="card col-sm-12">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-fw fa-map-marker-alt"></i> Endereços</h4>
                            <div class="float-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEndereco"><i class="fas fa-plus"></i> Endereço</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (count($registro->enderecos) > 0)
                                @foreach ($registro->enderecos as $endereco)
                                <div class="col-sm-12">
                                    <div class="callout callout-info">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <dl>
                                                    <dt>{{$endereco->tipo->nome}}</dt>
                                                    <dd>{{$endereco->logradouro}}, {{$endereco->numero}}@isset($endereco->complemento) - {{$endereco->complemento}}@endisset @isset($endereco->bairro)- {{$endereco->bairro}} @endisset- {{$endereco->cidade->nome}} / {{$endereco->cidade->estado->sigla}}@isset($endereco->cep) - CEP {{$endereco->cepFormatado()}}@endisset</dd>
                                                    @isset($endereco->observacao)
                                                    <dt>Observação</dt>
                                                    <dd>{{$endereco->observacao}}</dd>
                                                    @endisset
                                                </dl>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="float-right">
                                                    <div class="btn-group">
                                                        <button onclick="#" type="button" class="btn btn-sm btn-outline-warning"><i class="far fa-edit"></i> Editar</button>
                                                        {{ method_field('DELETE') }}
                                                        <button onclick="deleteEndereco('{{$endereco->id}}', '{{$registro->id}}')" type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-exclamation-triangle"></i> Excluir</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p>Não há endereços cadastrados</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card col-sm-12">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-fw fa-phone-alt"></i> Telefones</h4>
                            <div class="float-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTelefone"><i class="fas fa-plus"></i> Telefone</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (count($registro->telefones) > 0)
                                @foreach ($registro->telefones as $telefone)
                                <div class="col-sm-12">
                                    <div class="callout callout-info">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <dl>
                                                    <dt>{{$telefone->tipo->nome}}</dt>
                                                    <dd>
                                                        <a href="tel:@isset($telefone->ddd){{$telefone->ddd}}@endisset{{$telefone->numero}}">
                                                        @isset($telefone->ddd)
                                                        ({{$telefone->ddd}})
                                                        @endisset
                                                        {{$telefone->numeroFormatado()}}</a>@isset($telefone->ramal) (ramal {{$telefone->ramal}})@endisset
                                                    </dd>
                                                    @isset($telefone->operadora)
                                                    <dt>Operadora</dt>
                                                    <dd>{{$telefone->operadora->codigo}} - {{$telefone->operadora->nome}}</dd>
                                                    @endisset
                                                </dl>
                                            </div>
                                            <div class="col-sm-5">
                                                <dl>
                                                    @isset($telefone->observacao)
                                                    <dt>Observação</dt>
                                                    <dd>{{$telefone->observacao}}</dd>
                                                    @endisset
                                                </dl>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="float-right">
                                                    <div class="btn-group">
                                                        <button onclick="#" type="button" class="btn btn-sm btn-outline-warning"><i class="far fa-edit"></i> Editar</button>
                                                        {{ method_field('DELETE') }}
                                                    <button onclick="deleteTelefone('{{$telefone->id}}', '{{$registro->id}}')" type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-exclamation-triangle"></i> Excluir</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p>Não há telefones cadastrados</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.card-body -->

            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-8">
                        <small>Registro inserido em {{\Carbon\Carbon::parse($registro->created_at)->format('d/m/Y')}}, última atualização em {{\Carbon\Carbon::parse($registro->updated_at)->format('d/m/Y')}}</small>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-right">
                            {{ method_field('DELETE') }}
                            <button onclick="deleteData('{{$registro->id}}')" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-exclamation-triangle"></i> Excluir</button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.card -->
    </div><!-- /.col-md-12 -->
</div><!-- /.col -->

<!-- Modal -->
<div class="modal fade" id="modalEditar">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> {{$titleModal}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form role="form" action="{{route('pessoa.update', $registro->id)}}" method="post" id="formEditar">
                    <input name="_method" type="hidden" value="PATCH">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="nome">*Nome</label>
                                <input type="text" class="form-control" name="nome" maxlength="100" placeholder="" tabindex="-1" autofocus required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="nomeSocial">Nome Social</label>
                                <input type="text" class="form-control" name="nomeSocial" maxlength="100" placeholder="" />
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="utilizaNomeSocial" name="utilizaNomeSocial" value="1">
                                    <label for="utilizaNomeSocial" class="custom-control-label">Utiliza Nome Social</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="cargo">Cargo</label>
                                <input type="text" class="form-control" name="cargo" maxlength="100" placeholder="" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="empresa">Empresa</label>
                                <select name="empresa" id="empresa" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    <option selected data-select2-id="" value="">Selecione a empresa..</option>
                                    @foreach($empresas as $empresa)
                                    <option data-select2-id="{{$empresa->id}}" value="{{$empresa->id}}">{{$empresa->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dataNascimento">Data de Nascimento</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="dataNascimento" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="genero_id">Gênero</label>
                                <select name="genero_id" id="genero_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    <option selected data-select2-id="" value="">Selecione o gênero..</option>
                                    @foreach($generos as $genero)
                                    <option data-select2-id="{{$genero->id}}" value="{{$genero->id}}">{{$genero->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="cpf_cnpj">CPF (apenas números)</label>
                                <input type="number" class="form-control" name="cpf_cnpj" maxlength="14" placeholder="">
                            </div>
                            <input type="hidden" name="juridica" value="0">
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="rg_ie">*RG</label>
                            <input type="number" class="form-control" name="rg_ie" maxlength="20" placeholder="" required>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="formEditar" class="btn btn-primary">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Novo Telefone -->
<div class="modal fade" id="modalTelefone">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Número de telefone</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form role="form" action="{{route('telefone.store')}}" method="post" id="formTelefone">
                    {{csrf_field()}}
                <input type="hidden" name="pessoa_id" value="{{$registro->id}}">

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                            <label for="ddd">DDD</label>
                            <input type="number" class="form-control" name="ddd" min="1" max="9999" placeholder="(     )" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" name="numero" maxlength="15" placeholder="" autofocus required />
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                            <label for="ramal">Ramal</label>
                            <input type="text" class="form-control" name="ramal" maxlength="10" placeholder="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6" data-select2-id="2">
                            <div class="form-group">
                                <label for="tipo_telefone_id">Tipo</label>
                                <select name="tipo_telefone_id" id="tipo_telefone_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    <option selected data-select2-id="" value="">Selecione o tipo de telefone..</option>
                                    @foreach($tipos as $tipo)
                                    <option data-select2-id="{{$tipo->id}}" value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6" data-select2-id="2">
                            <div class="form-group">
                                <label for="operadora_id">Operadora</label>
                                <select name="operadora_id" id="operadora_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    <option selected data-select2-id="" value="">Selecione a operadora..</option>
                                    @foreach($operadoras as $operadora)
                                    <option data-select2-id="{{$operadora->id}}" value="{{$operadora->id}}">{{$operadora->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="observacao">Observação</label>
                                <textarea name="observacao" class="form-control" rows="3" maxlength="300" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="formTelefone" class="btn btn-primary" id="salvarTelefone">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal telefone -->

<!-- Modal Novo Endereço -->
<div class="modal fade" id="modalEndereco">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Endereço</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form role="form" action="{{route('endereco.store')}}" method="post" id="formEndereco">
                    {{csrf_field()}}
                    <input type="hidden" name="pessoa_id" value="{{$registro->id}}">

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep" maxlength="20" placeholder="" autofocus />
                            </div>
                        </div>

                        <div class="col-sm-7" data-select2-id="2">
                            <div class="form-group">
                                <label for="tipo_endereco_id">Tipo</label>
                                <select name="tipo_endereco_id" id="tipo_endereco_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    <option selected data-select2-id="" value="">Selecione o tipo de endereço..</option>
                                    @foreach($tiposEnd as $tipo)
                                    <option data-select2-id="{{$tipo->id}}" value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="logradouro">Logradouro</label>
                                <input type="text" class="form-control" name="logradouro" id="logradouro" maxlength="200" placeholder="" required />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" name="numero" maxlength="20" placeholder="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" maxlength="150" placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="complemento">Complemento</label>
                                <input type="text" class="form-control" name="complemento" id="complemento" maxlength="200" placeholder="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6" data-select2-id="1">
                            <div class="form-group">
                                <label for="pais_idD">País</label>
                                <select name="pais_idD" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" aria-hidden="true" disabled>
                                    <option data-select2-id="1" value="1">Brasil</option>
                                </select>
                                <input type="hidden" value="1" name="pais_id"/>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-sm-6" data-select2-id="2">
                            <div class="form-group">
                                <label for="estado_id">Estado</label>
                                <select name="estado_id" id="estado_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    <option selected data-select2-id="" value="">Selecione o estado..</option>
                                    {{-- @foreach($estados as $estado)
                                    <option data-select2-id="{{$estado->id}}" value="{{$estado->id}}">{{$estado->nome}}</option>
                                    @endforeach --}}
                                </select>
                            </div><!-- /.form-group -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12" data-select2-id="3">
                            <div class="form-group">
                                <label for="cidade_id">Cidade</label>
                                <select name="cidade_id" id="cidade_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" aria-hidden="true">
                                </select>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="formEndereco" class="btn btn-primary" id="salvarEndereco">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal endereço -->

<!-- Modal -->
<div class="modal fade" id="modalFoto">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Foto de Perfil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" role="form" action="{{route('imagem.store', $registro->id)}}" method="post" id="formEditar">
                    <input name="_method" type="hidden" value="PATCH">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                                <div><input name="imagem" type="file"/></div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="formFoto" class="btn btn-primary">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('js')
<script>
$(document).on('shown.bs.modal', function (e) {
    $('[autofocus]', e.target).focus();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('.select2').select2();

    $.ajax({
        type: "GET",
        url: "{{url('/api/listaestados')}}/1", // + pais,
        data: {_method: 'get'},
        success: function(data){
            $('#estado_id').append(
                data.estados.map(function(estado) {
                    return $('<option/>', {
                    'data-select2-id': estado.id,
                    'data-estado-sigla': estado.sigla.trim().toLowerCase(),
                    value: estado.id,
                    text: estado.nome
                })
            })
        )},
        statusCode: {
            404: function() {
            toastr.error( "País não encontrado");
            }
        },
        error : function(){
            toastr.error( "Falha ao buscar o País", "Ops!");
        }
    })
});

$('#cep').blur(function() {
    var cep = $('#cep').val();
    if(cep != '')
        $.ajax({
            type: "GET",
            url: "{{url('/api/getcep')}}/" + cep,
            data: {_method: 'get'},
            success: function(data){
                $('#logradouro').val(data['logradouro']);
                $('#bairro').val(data['bairro']);
                selecionaCidade(data);
            },
            statusCode: {
                404: function() {
                toastr.error( "CEP não encontrado");
                }
            },
            error : function(){
                toastr.error( "Falha ao buscar o CEP", "Ops!");
            }
        })
}, );

function selecionaEstado(data) {
    return new Promise((resolve, reject) => {
        var selectEstado = $('[data-estado-sigla="' + data['uf'].trim().toLowerCase() + '"]');
        selectEstado.removeAttr('selected');
        selectEstado.attr("selected", true);
        selectEstado.trigger('change');
        resolve();
    });
}

async function selecionaCidade(data) {
    await selecionaEstado(data);
    await carregou;
    var cidade = data['cidade'].trim().toLowerCase();
    var selectCidade = $('[data-cidade-nome="' + cidade + '"]');
    selectCidade.removeAttr('selected');
    selectCidade.attr("selected", true);
    selectCidade.trigger('change');
}

$("#estado_id" ).change(function() {
    carregou = new Promise((res, rej)=>{
        if ($(this).val() != '') {
        var id = $(this).val();

            $.ajax({
                url:"{{url('/api/listacidades')}}/" + id,
                type: "GET",
                data: {id:id},
                success:function(data){
                    var cidade = $('#cidade_id');
                    cidade.val(null);
                    cidade.html('').select2({data: [{id: '', text: ''}]}).trigger('change');
                    cidade.append('<option selected data-select2-id="" value="">Selecione a cidade..</option>');
                    cidade.append(
                        data.cidades.map(function(cidade) {
                            return $('<option/>', {
                                'data-select2-id': cidade.id,
                                'data-cidade-nome': cidade.nome.trim().toLowerCase(),
                                value: cidade.id,
                                text: cidade.nome
                            })
                        })
                    ).trigger('change');
                }
            });
        } else {
            $('#cidade_id').val(null).trigger('change');
            $('#cidade_id').append('<option selected data-select2-id="" data-cidade-nome="" value="">Selecione a cidade..</option>').trigger('change');
        }
        setTimeout(() => {
            res();
        }, 1200);
    });
});

function deleteData(id, tipo){

    Swal.fire({
        title: "Você tem certeza?",
        text: "Depois de excluir, você não pode mais recuperar este registro!",
        type: "warning",
        confirmButtonText: 'Excluir',
        confirmButtonColor: 'red',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: "{{url('/pessoa')}}/"+id,
                data: {_method: 'delete'},
                success: function(data){
                    toastr.success("Registro excluído com sucesso.", "Feito!");
                    window.location.href = "{{url('/pessoa')}}";
                },
                statusCode: {
                    404: function() {
                    toastr.error( "Página não encontrada");
                    }
                },
                error : function(){
                    toastr.error( "Falha ao excluir registro", "Ops!");
                }
            })
        }
    });
}

function deleteTelefone(id, idPessoa){

    Swal.fire({
        title: "Você tem certeza?",
        text: "Depois de excluir, você não pode mais recuperar este registro!",
        type: "warning",
        confirmButtonText: 'Excluir',
        confirmButtonColor: 'red',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: "{{url('/telefone')}}/"+id,
                data: {_method: 'delete'},
                success: function(data){
                    toastr.success("Registro excluído com sucesso.", "Feito!");
                    var url = '{{url("/pessoa/:id")}}';
                    url = url.replace(':id', idPessoa);
                    window.location.href = url;
                },
                statusCode: {
                    404: function() {
                    toastr.error( "Página não encontrada");
                    }
                },
                error : function(){
                    toastr.error( "Falha ao excluir registro", "Ops!");
                }
            })
        }
    });
}

function deleteEndereco(id, idPessoa){

    Swal.fire({
        title: "Você tem certeza?",
        text: "Depois de excluir, você não pode mais recuperar este registro!",
        type: "warning",
        confirmButtonText: 'Excluir',
        confirmButtonColor: 'red',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: "{{url('/endereco')}}/"+id,
                data: {_method: 'delete'},
                success: function(data){
                    toastr.success("Registro excluído com sucesso.", "Feito!");
                    var url = '{{url("/pessoa/:id")}}';
                    url = url.replace(':id', idPessoa);
                    window.location.href = url;
                },
                statusCode: {
                    404: function() {
                    toastr.error( "Página não encontrada");
                    }
                },
                error : function(){
                    toastr.error( "Falha ao excluir registro", "Ops!");
                }
            })
        }
    });
}

</script>
@endsection
