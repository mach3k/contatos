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
            <li class="breadcrumb-item"><a href="{{route('cidade.index')}}">Região</a></li>
            <li class="breadcrumb-item"><a href="{{route('estado.index')}}">Estado</a></li>
            <li class="breadcrumb-item"><a href="{{route('mesorregiao.index')}}">Mesorregião</a></li>
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
                            <th>Mesorregião</th>
                            <th>Estado</th>
                            <th>País</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($registros as $registro)
                    <tr style="cursor:pointer">
                        <td>{{$registro->id}}</td>
                        <td>{{$registro->nome}}</td>
                        <td>{{$registro->mesorregiao->nome}}</td>
                        <td>{{$registro->estado->nome}}</td>
                        <td>{{$registro->estado->pais->nome}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Mesorregião</th>
                            <th>Estado</th>
                            <th>País</th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.card-body -->

            <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                    {!! $registros->links() !!}
                </nav>
            </div>
        </div><!-- /.card -->
    </div><!-- /.col-md-12 -->
</div><!-- /.col -->

<!-- Modal -->
<div class="modal fade" id="modalNovo">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nova {{$titleModal}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form role="form" action="{{route('cidade.store')}}" method="post" id="formNovo">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" maxlength="100" placeholder="Nome do registro..." tabindex="-1" autofocus required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6" data-select2-id="1">
                            <div class="form-group">
                                <label for="pais_idD">País</label>
                                <select name="pais_idD" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" aria-hidden="true" disabled>
                                    @foreach($paises as $pais)
                                    <option data-select2-id="{{$pais->id}}" value="{{$pais->id}}">{{$pais->nome}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" value="1" name="pais_id"/>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-sm-6" data-select2-id="2">
                            <div class="form-group">
                                <label for="estado_id">Estado</label>
                                <select name="estado_id" id="estado_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" aria-hidden="true">
                                    <option selected data-select2-id="" value="">Selecione o estado..</option>
                                    @foreach($estados as $estado)
                                    <option data-select2-id="{{$estado->id}}" value="{{$estado->id}}">{{$estado->nome}}</option>
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
                                    {{-- <option data-select2-id="" value="">Selecione a mesorregião..</option> --}}
                                    {{-- @endforeach --}}
                                </select>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="ddd">DDD</label>
                            <input type="text" class="form-control" name="ddd" maxlength="3" placeholder="">
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
                            <input type="text" class="form-control" name="iName" maxlength="100" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="geoNameId">ID GeoNames</label>
                            <input type="text" class="form-control" name="geoNameId" maxlength="7" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="codigoIbge">Código IBGE</label>
                            <input type="text" class="form-control" name="codigoIbge" maxlength="3" placeholder="">
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
        "paging": false,
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

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#estado_id" ).change(function() {
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
    };
});

</script>
@endsection
