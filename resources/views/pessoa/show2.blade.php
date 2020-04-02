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
            <li class="breadcrumb-item active">Marcelo</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="PessoaCard" registro='{!! json_encode($registro) !!}' baseUrl={{url('/')}}></div>
    </div><!-- /.col-md-12 -->
</div><!-- /.col -->
@endsection

@section('js')
@endsection

