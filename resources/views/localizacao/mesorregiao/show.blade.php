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
            <li class="breadcrumb-item"><a href="{{route('pais.index')}}">País</a></li>
            <li class="breadcrumb-item"><a href="{{route('regiao.index')}}">Região</a></li>
            <li class="breadcrumb-item"><a href="{{route('estado.index')}}">Estado</a></li>
            <li class="breadcrumb-item"><a href="{{route('mesorregiao.index')}}">{{$titleModal}}</a></li>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                    <dl>
                        <dt>Nome</dt>
                        <dd>{{$registro->nome}}</dd>

                        <dt>Estado</dt>
                        @if(isset($registro->estado->nome))
                            <dd>{{$registro->estado->nome}}</dd>
                        @else
                            <dd>Não informado.</dd>
                        @endif

                        <dt>Código IBGE</dt>
                        @if(isset($registro->codigoIbge))
                            <dd>{{$registro->codigoIbge}}</dd>
                        @else
                            <dd>Não informado.</dd>
                        @endif
                    </div>

                    <div class="col-sm-6">

                        <dt>Nome Internacional</dt>
                        @if(isset($registro->iName))
                            <dd>{{$registro->iName}}</dd>
                        @else
                            <dd>Não informado.</dd>
                        @endif

                        <dt>Código GeoNames</dt>
                        @if(isset($registro->geoNameId))
                            <dd>{{$registro->geoNameId}}</dd>
                        @else
                            <dd>Não informado.</dd>
                        @endif

                    </dl>
                    </div>
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
                <form role="form" action="{{route('mesorregiao.update', $registro->id)}}" method="post" id="formEditar">
                    <input name="_method" type="hidden" value="PATCH">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{$registro->nome}}" maxlength="150" placeholder="Nome do registro..." tabindex="-1" autofocus required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6" data-select2-id="1">
                            <div class="form-group">
                                <label for="pais_idD">País</label>
                                <select name="pais_idD" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" aria-hidden="true" disabled>
                                    @foreach($paises as $pais)
                                        @if ($pais->id == $registro->pais_id)
                                        <option selected data-select2-id="{{$pais->id}}" value="{{$pais->id}}">{{$pais->nome}}</option>
                                        @else
                                        <option data-select2-id="{{$pais->id}}" value="{{$pais->id}}">{{$pais->nome}}</option>
                                        @endif
                                    @endforeach
                                </select>
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
                url: "{{url('/mesorregiao')}}/" + id,
                data: {_method: 'delete'},
                success: function(data){
                    toastr.success("Registro excluído com sucesso.", "Feito!");
                    window.location.href = "{{url('/mesorregiao')}}";
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
