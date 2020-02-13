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
            <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@stop

@section('content')
<div class="card card-solid">

    <div class="card-header">
        <div class="row">
            <div class="col-sm-6">
                <form role="form" action="{{route('pessoa.search')}}" method="post" ">
                    {{csrf_field()}}
                    <div class="input-group mb-6">
                        <input name="search" name="search" type="text" class="form-control" placeholder="Procurar...">
                        <div class="input-group-append">
                            <button type="submit" id="btnSearch" class="btn btn-default" alt="Limpar dados da pesquisa"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-3">
                <a href="{{route('pessoa.index')}}" class="btn btn-primary" ><i class="fas fa-eraser"></i></a>
            </div>
            <div class="col-sm-3">
                <div class="float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNovo">Novo registro</button>
                </div>
            </div>
        </div>
    </div> <!-- /.card-header -->

    <div class="card-body pb-0">
      <div class="row d-flex align-items-stretch">

        @foreach ($registros as $registro)

        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <div class="card bg-light w-100">
                <div class="card-header text-muted border-bottom-0">
                {{$registro->cargo}}
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>{{$registro->getNome()}}</b></h2>

                            @isset($registro->empregador)
                            <p class="text-muted text-sm"><b>À serviço de: </b><br/> {{$registro->empregador->getNome()}} </p>
                            @endisset

                        </div>
                        <div class="col-5 text-center">
                            @isset($registro->foto)
                            <img class="img-circle img-fluid" src="{{ url("storage/pessoas/{$registro->foto->nome}") }}" alt="Photo">
                            @else
                            <img src="{{asset('storage/images/sem_foto.png')}}" alt="" class="img-circle img-fluid">
                            @endisset
                        </div>
                    </div>

                    <div class="row">
                        <ul class="ml-4 mb-0 fa-ul text-muted">

                            <li class="small">
                                <span class="fa-li">
                                <i class="fas fa-sm fa-map-marker-alt"></i> </span>
                                @isset($registro->endereco->logradouro)
                                {{$registro->endereco->logradouro}}, {{$registro->endereco->numero}} - {{$registro->endereco->cidade->nome}} / {{$registro->endereco->cidade->estado->sigla}}
                                @else
                                Não informado
                                @endisset
                            </li>

                            <li class="small">
                                <span class="fa-li"><i class="fas fa-sm fa-phone"></i> </span>
                                @isset($registro->telefone)
                                ({{$registro->telefone->ddd}}) {{$registro->telefone->numeroFormatado()}}
                                @else
                                Não informado
                                @endisset
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{route('pessoa.show', $registro->id)}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> Ver Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

      </div>
    </div> <!-- /.card-body -->

    <div class="card-footer">
        <nav aria-label="Contacts Page Navigation">
            @isset($form)
            {!! $registros->appends($form)->links() !!}
            <p class="text-muted">Filtrando registros contendo '{{$form['search']}}'</p>
            @else
            {!! $registros->links() !!}
            @endisset
        </nav>
    </div> <!-- /.card-footer -->

</div>

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
                <form role="form" action="{{route('pessoa.store')}}" method="post" id="formNovo">
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

var input = $("#search");

input.on("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        $("#btnSearch").click();
    }
});

</script>
@endsection
