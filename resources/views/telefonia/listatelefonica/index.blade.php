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
            <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@stop

@section('content')
<div class="card card-solid">

    <div class="card-body">
        <table id="tabela" class="table table-bordered table-striped">
            <thead>
                <tr style="cursor:pointer">
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>CPF/CNPJ</th>
                </tr>
            </thead>
            <tbody>
            @foreach($registros as $registro)
            <tr style="cursor:pointer">
                <td>{{$registro->id}}</td>
                <td>{{$registro->pessoa->getNome()}}</td>
                <td>{{$registro->numeroFormatadoComDDD()}}</td>
                <td>{{$registro->pessoa->cpfCnpjFormatado()}}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>CPF/CNPJ</th>
                </tr>
            </tfoot>
        </table>
    </div> <!-- /.card-body -->

</div>

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

$('#tabela tbody').on( 'click', 'tr', function () {
    if (window.location.href.indexOf("telefone") > -1){
        window.location.assign(document.URL.concat('/', table.row( this ).data()[0]));
    } else if (window.location.href.indexOf("home") > -1) {
        window.location.assign(document.URL.concat('/', table.row( this ).data()[0]));
    } else {
        window.location.assign(document.URL.concat('/telefone/', table.row( this ).data()[0]));
    }
} );
</script>
@endsection
