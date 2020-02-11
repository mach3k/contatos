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
            <li class="breadcrumb-item active">{{$title}}</li>
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
                <h3 class="card-title">Registros</h3>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalNovo">Novo registro</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabela" class="table table-bordered table-striped table-pointer">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Região</th>
                            <th>País</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($registros as $registro)
                    <tr style="cursor:pointer">
                        <td>{{$registro->id}}</td>
                        <td>{{$registro->nome}}</td>
                        <td>{{$registro->sigla}}</td>
                        <td>{{$registro->regiao->nome}}</td>
                        <td>{{$registro->pais->nome}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Região</th>
                            <th>País</th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col-md-12 -->
</div><!-- /.col -->

<!-- Modal -->
<div class="modal fade" id="modalNovo">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Novo {{$titleModal}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form role="form" action="{{route('estado.store')}}" method="post" id="formNovo">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="col-sm-10">
                            <!-- text input -->
                            <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" maxlength="100" placeholder="Nome do registro..." tabindex="-1" autofocus required>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                            <label for="sigla">Sigla</label>
                            <input type="text" class="form-control" name="sigla" maxlength="2" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6" data-select2-id="1">
                            <div class="form-group">
                                <label for="pais_id">País</label>
                                <select name="pais_id" id="pais_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" aria-hidden="true" disabled>
                                    {{-- @foreach($paises as $pais) --}}
                                    <option data-select2-id="1" value="1" selected>Brasil</option>
                                    {{-- @endforeach --}}
                                </select>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-sm-6" data-select2-id="2">
                            <div class="form-group">
                                <label for="regiao_id">Região</label>
                                <select name="regiao_id" id="regiao_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    @foreach($regioes as $regiao)
                                    <option data-select2-id="{{$regiao->id}}" value="{{$regiao->id}}">{{$regiao->nome}}</option>
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
                                <input type="text" class="form-control" name="iName" maxlength="100" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="codigoIbge">Código IBGE</label>
                                <input type="text" class="form-control" name="codigoIbge" maxlength="3" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="geoNameId">ID GeoNames</label>
                                <input type="text" class="form-control" name="geoNameId" maxlength="7" placeholder="">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="formNovo" class="btn btn-primary" id="salvar">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('js')
<script>
var table = $('#tabela').DataTable({
        "paging": true,
        "responsive": true,
        "processing": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": {
            "decimal":        "",
            "emptyTable":     "A tabela está vazia",
            "info":           "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrando de 0 a 0 de 0 registros",
            "infoFiltered":   "(filtrado do total _MAX_ de registros)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar até _MENU_ registros",
            "loadingRecords": "Carregando...",
            "processing":     "Processando...",
            "search":         "Procurar:",
            "zeroRecords":    "Nenhum registro encontrado",
            "paginate": {
                "first":      "Primeira",
                "previous":   "Anterior",
                "next":       "Próxima",
                "last":       "Última"
            },
            "aria": {
                "sortAscending":  ": organiza a coluna de modo ascendente",
                "sortDescending": ": organiza a coluna de modo descendente"
            }

        }
    });

$(document).on('shown.bs.modal', function (e) {
    $('[autofocus]', e.target).focus();
});

$(document).ready(function() {
    $('.select2').select2()
});

$('#tabela tbody').on( 'click', 'tr', function () {
    window.location.assign(document.URL.concat('/', table.row( this ).data()[0]));
} );
</script>
@endsection
