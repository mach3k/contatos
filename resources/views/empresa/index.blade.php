@extends('adminlte::page')

@section('title')
{{$title}}
@endsection

@section('content_header')

  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{$title}}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
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
            </div><!-- /.card-header -->

            <div class="card-body">
                <table id="tabela" class="table table-bordered table-striped table-pointer">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>CNPJ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($registros as $registro)
                    <tr style="cursor:pointer">
                        <td>{{$registro->id}}</td>
                        <td>{{$registro->nome}}</td>
                        <td>{{$registro->nomeSocial}}</td>
                        <td>{{$registro->cnpjFormatado()}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>CNPJ</th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.card-body -->

            {{-- <div class="card-footer">
              <nav aria-label="Contacts Page Navigation">
                {!! $registros->links() !!}
              </nav>
            </div> <!-- /.card-footer --> --}}

        </div><!-- /.card -->
    </div><!-- /.col-md-12 -->
</div><!-- /.col -->

<!-- Modal Novo Registro -->
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
                <form role="form" action="{{route('empresa.store')}}" method="post" id="formNovo">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label for="nome">Razão Social</label>
                            <input type="text" class="form-control" name="nome" maxlength="100" placeholder="" tabindex="-1" autofocus required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label for="nomeSocial">*Nome Fantasia</label>
                            <input type="text" class="form-control" name="nomeSocial" maxlength="100" placeholder="" required />
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" id="utilizaNomeSocial" name="utilizaNomeSocial" value="1">
                                  <label for="utilizaNomeSocial" class="custom-control-label">Utiliza Nome Fantasia</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="cpf_cnpj">CNPJ (apenas números)</label>
                                <input type="number" class="form-control" name="cpf_cnpj" maxlength="14" placeholder="">
                            </div>
                            <input type="hidden" name="juridica" value="1">
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="rg_ie">Inscrição Estadual</label>
                            <input type="number" class="form-control" name="rg_ie" maxlength="20" placeholder="">
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
</div><!-- /.modal novo -->
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
