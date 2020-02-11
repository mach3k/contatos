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
            <li class="breadcrumb-item"><a href="{{route('pais.index')}}">{{$titleModal}}</a></li>
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

                            <dt>Sigla</dt>
                            @if(isset($registro->sigla))
                                <dd>{{$registro->sigla}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif

                            <dt>Código de Discagem Internacional</dt>
                            @if(isset($registro->ddi))
                                <dd>{{$registro->ddi}}</dd>
                            @else
                                <dd>Não informado.</dd>
                            @endif
                        </dl>
                    </div>
                    <div class="col-sm-6">
                        <dl>
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
                <form role="form" action="{{route('pais.update', $registro->id)}}" method="post" id="formEditar">
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
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="sigla">Sigla</label>
                            <input type="text" class="form-control" name="sigla" maxlength="2" value="{{$registro->sigla}}" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="ddi">DDI</label>
                            <input type="text" class="form-control" name="ddi" maxlength="7" value="{{$registro->ddi}}" placeholder="">
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
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label for="geoNameId">ID GeoNames</label>
                            <input type="text" class="form-control" name="geoNameId" maxlength="7" value="{{$registro->geoNameId}}" placeholder="">
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
                url: "{{url('/pais')}}/" + id,
                data: {_method: 'delete'},
                success: function(data){
                    toastr.success("Registro excluído com sucesso.", "Feito!");
                    window.location.href = "{{url('/pais')}}";
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
