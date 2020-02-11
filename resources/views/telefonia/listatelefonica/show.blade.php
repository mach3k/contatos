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
                            <dd>{{$registro->nomeSocial}}</dd>
                            @if($registro->utilizaNomeSocial)
                            <dd>*Utiliza nome social</dd>
                            @endisset

                            <dt>Data de nascimento</dt>
                            <dd>{{ \Carbon\Carbon::parse($registro->dataNascimento)->format('j F, Y') }}</dd>

                            <dt>Sexo</dt>
                            @if(isset($registro->genero))
                                <dd>{{$registro->genero->nome}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif
                        </div>

                        <div class="col-sm-4">
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
                                <dd>{{$registro->cpf_cnpj}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif

                            <dt>RG</dt>
                            @if(isset($registro->rg_ie))
                                <dd>{{$registro->rg_ie}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif

                            <dt>Situação no sistema</dt>
                            @if($registro->ativo)
                                <dd>Ativo</dd>
                            @else
                                <dd>Inativo</dd>
                            @endif
                        </dl>
                    </div>
                </div>

                <div class="row">

                </div>

            </div><!-- /.card-body -->

            <div class="card-footer">
                <div class="text-right">
                    {{ method_field('DELETE') }}
                    <button onclick="deleteData('{{$registro->id}}')" class="btn btn-sm btn-outline-danger">
                      <i class="fas fa-exclamation-triangle"
                      ></i> Excluir</button>
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
                            <!-- text input -->
                            <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{$registro->nome}}" maxlength="100" placeholder="Nome do registro..." tabindex="-1" autofocus required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6" data-select2-id="1">
                            <div class="form-group">
                                <label for="pais_idD">País</label>
                                <select name="pais_idD" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" aria-hidden="true" disabled>
                                    <option selected data-select2-id="1" value="1">Brasil</option>
                                </select>
                            <input type="hidden" value="{{$registro->pais_id}}" name="pais_id"/>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-sm-6" data-select2-id="2">
                            <div class="form-group">
                                <label for="estado_id">Estado</label>
                                <select name="estado_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    @foreach($estados as $estado)
                                        @if ($estado->id == $registro->estado_id)
                                        <option selected data-select2-id="{{$estado->id}}" value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                        <option data-select2-id="{{$estado->id}}" value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6" data-select2-id="3">
                            <div class="form-group">
                                <label for="mesorregiao_id">Mesorregião</label>
                                <select name="mesorregiao_id" id="mesorregiao_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" aria-hidden="true">
                                    {{-- @foreach($mesorregioes as $mesorregiao) --}}
                                    {{-- <option data-select2-id="{{$mesorregiao->id}}" value="{{$mesorregiao->id}}">{{$mesorregiao->nome}}</option> --}}
                                    <option data-select2-id="" value="">Selecione a mesorregião..</option>
                                    {{-- @endforeach --}}
                                </select>
                                <input type="hidden" value="{{$registro->mesorregiao_id}}" id="mesorregiao_sel"/>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="ddd">DDD</label>
                            <input type="text" class="form-control" name="ddd" value="{{$registro->ddd}}" maxlength="3" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-info"></i> Para recursos completos</h5>
                                de geolocalização mundial, contrate o desenvolvedor. <i class="far fa-laugh-wink"></i>
                              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label for="iName">Nome Internacional</label>
                            <input type="text" class="form-control" name="iName" maxlength="100" value="{{$registro->iName}}" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="geoNameId">ID GeoNames</label>
                            <input type="text" class="form-control" name="geoNameId" maxlength="7" value="{{$registro->geoNameId}}" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="codigoIbge">Código IBGE</label>
                            <input type="text" class="form-control" name="codigoIbge" value="{{$registro->codigoIbge}}" maxlength="3" placeholder="">
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
@endsection

@section('js')
<script>
$(document).on('shown.bs.modal', function (e) {
    $('[autofocus]', e.target).focus();
});

$(document).ready(function() {
    $('.select2-hidden-accessible').select2();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function deleteData(id){

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
                url: "{{url('/pessoa')}}/" + id,
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

$("#estado_id" ).change(function() {
    if ($(this).val() != '') {
        console.log("entrou no if");
        var id = $(this).val();
        // var selecionado = $('mesorregiao_sel').val();
        var selecionado = "{{$registro->mesorregiao_id}}";

        $.ajax({
            url:"{{route('getmesobyestado')}}",
            type: "POST",
            data: {id:id, selecionado: selecionado},
            success:function(result){
                $("#mesorregiao_id").html(result);
            }
        });
    } else{
        console.log("entrou no else");
        $("#mesorregiao_id").html('<option data-select2-id="" value="">Selecione a mesorregião..</option>');
    }
});
</script>
@endsection
