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
            <li class="breadcrumb-item"><a href="{{route('mesorregiao.index')}}">Mesorregião</a></li>
            <li class="breadcrumb-item"><a href="{{route('cidade.index')}}">{{$titleModal}}</a></li>
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

                        <dt>DDD</dt>
                        @if(isset($registro->ddd))
                            <dd>{{$registro->ddd}}</dd>
                        @else
                            <dd>Não informado.</dd>
                        @endif

                        <dt>Estado</dt>
                        @if(isset($registro->estado->nome))
                            <dd>{{$registro->estado->nome}}</dd>
                        @else
                            <dd>Não informado.</dd>
                        @endif

                        <dt>Mesorregião</dt>
                        @if(isset($registro->mesorregiao->nome))
                            <dd>{{$registro->mesorregiao->nome}}</dd>
                        @else
                            <dd>Não informado.</dd>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        <dt>Código IBGE</dt>
                        @if(isset($registro->codigoIbge))
                            <dd>{{$registro->codigoIbge}}</dd>
                        @else
                            <dd>Não informado.</dd>
                        @endif

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
                <form role="form" action="{{route('cidade.update', $registro->id)}}" method="post" id="formEditar">
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
                                <label for="pais_id">País</label>
                                <select name="pais_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" aria-hidden="true" disabled>
                                    {{-- @foreach($paises as $pais)
                                        @if ($pais->id == $registro->pais_id) --}}
                                        <option selected data-select2-id="1" value="1">Brasil</option>
                                        {{-- @else
                                        <option data-select2-id="{{$pais->id}}" value="{{$pais->id}}">{{$pais->nome}}</option>
                                        @endif --}}
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6" data-select2-id="2">
                            <div class="form-group">
                                <label for="estado_id">Estado</label>
                                <select name="estado_id" id="estado_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    {{-- @foreach($estados as $estado)
                                        @if ($estado->id == $registro->estado_id)
                                        <option selected data-select2-id="{{$estado->id}}" value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                        <option data-select2-id="{{$estado->id}}" value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6" data-select2-id="3">
                            <div class="form-group">
                                <label for="mesorregiao_id">Mesorregião</label>
                                <select name="mesorregiao_id" id="mesorregiao_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" aria-hidden="true">
                                    {{-- @foreach($mesorregioes as $mesorregiao) --}}
                                    {{-- <option data-select2-id="{{$mesorregiao->id}}" value="{{$mesorregiao->id}}">{{$mesorregiao->nome}}</option> --}}
                                    {{-- <option data-select2-id="" value="">Selecione a mesorregião..</option> --}}
                                    {{-- @endforeach --}}
                                </select>
                                {{-- <input type="hidden" value="{{$registro->mesorregiao_id}}" id="mesorregiao_sel"/> --}}
                            </div>
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

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('.select2-hidden-accessible').select2();

    selecionaMeso('{{$registro->estado->id}}', '{{$registro->mesorregiao->id}}');
});

function carregaEstados(){
    return new Promise((res, rej)=>{
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
                ).trigger('change');
            },
            statusCode: {
                404: function() {
                toastr.error( "País não encontrado");
                }
            },
            error : function(){
                toastr.error( "Falha ao buscar o País", "Ops!");
            }
        });
        setTimeout(() => {
            res();
        }, 1000);
    })
}

function selecionaEstado(id) {
    return new Promise((resolve, reject) => {
        var selectEstado = $("#estado_id").val(id);
        selectEstado.removeAttr('selected');
        selectEstado.attr("selected", true);
        selectEstado.trigger('change');
        resolve();
    });
}

async function selecionaMeso(idEstado, idMeso) {
    await carregaEstados();
    await selecionaEstado(idEstado);
    await carregou;
    var selectMeso = $("#mesorregiao_id").val(idMeso);
    selectMeso.removeAttr('selected');
    selectMeso.attr("selected", true);
    selectMeso.trigger('change');
}

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
                url: "{{url('/cidade')}}/" + id,
                data: {_method: 'delete'},
                success: function(data){
                    toastr.success("Registro excluído com sucesso.", "Feito!");
                    window.location.href = "{{url('/cidade')}}";
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
    carregou = new Promise((res, rej)=>{
        if ($(this).val() != '') {
            var id = $(this).val();

            $.ajax({
                url:"{{url('/api/listamesorregioes')}}/" + id,
                type: "GET",
                data: {id:id},
                success:function(data){
                    var mesorregiao = $('#mesorregiao_id');
                    mesorregiao.val(null);
                    mesorregiao.html('').select2({data: [{id: '', text: ''}]}).trigger('change');
                    mesorregiao.append('<option selected data-select2-id="" value="">Selecione a mesorregião..</option>');
                    mesorregiao.append(
                        data.mesorregioes.map(function(mesorregiao) {
                            return $('<option/>', {
                                'data-select2-id': mesorregiao.id,
                                'data-mesorregiao-nome': mesorregiao.nome.trim().toLowerCase(),
                                value: mesorregiao.id,
                                text: mesorregiao.nome
                            })
                        })
                    ).trigger('change');
                }
            });
        } else {
            $('#mesorregiao_id').val(null).trigger('change');
            $('#mesorregiao_id').append('<option selected data-select2-id="" data-mesorregiao-nome="" value="">Selecione a mesorregião..</option>').trigger('change');
        }
        setTimeout(() => {
            res();
        }, 1200);
    });
});

</script>
@endsection
