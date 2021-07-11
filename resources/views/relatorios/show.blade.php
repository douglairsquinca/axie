@extends('layouts.app')

@section('title', 'Listagem de Despesas')


@section('content')
@include('layouts.navbars.navbar')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">

                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('relatorios.index')}}">Detalhe da Despesa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista</li>
                        </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('relatorios.searchMonth',$despesa->user_id)}}" class="btn btn-sm btn-neutral">Voltar</a>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <!-- Card image -->
                    <img class="card-img-top" src="{{ url("storage/{$despesa->image}")}}" alt="">
                    <!-- Card body -->
                    <div class="card-body">
                        <h5 class="h2 card-title mb-0">{{$despesa->descricao}}</h5>
                        <small class="text-muted">Data da despesa: {{$despesa->data}}</small>

                    </div>
                </div>
            </div>
            <div class="col-lg-8">

                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Detalhes da Despesa</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- List group -->
                        <ul class="list-group list-group-flush list my--3">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <i class="ni ni-money-coins"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Valor:</h5>
                                        <div class="">
                                            {{$despesa->valor}}
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <i class="ni ni-building"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Projeto:</h5>
                                        <div class="">
                                            @foreach ($projetos as $projeto)
                                                @if($projeto->id == $despesa->projeto_id) {{$projeto->nome}}  @endif
                                            @endforeach
                                            <span class="mb-0 text-sm"> {{$despesa->projeto}}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">

                                            <i class="ni ni-credit-card"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Forma de Pagamento</h5>
                                        <div class="">
                                            @foreach ($pagamento as $pag)
                                                @if($pag["value"] == $despesa->formaPagamento) {{$pag["tipo"]}}  @endif
                                            @endforeach
                                            <span class="mb-0 text-sm"> {{$despesa->projeto}}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <i class="ni ni-cart"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Tipo de Despesa</h5>
                                        <div class="">
                                            @foreach ($tipo_despesas as $tipo)
                                                @if($tipo["value"] == $despesa->tipoDespesa) {{$tipo["tipo"]}}  @endif
                                            @endforeach
                                            <span class="mb-0 text-sm"> {{$despesa->descricao}}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <i class="ni ni-single-copy-04"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Observação:</h5>
                                        <div class="">
                                           {{$despesa->obs}}
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="#" class="avatar rounded-circle">
                                            <i class="ni ni-image"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h5>Baixar Imagem Despesa:</h5>
                                        <a href="{{ url("storage/{$despesa->image}")}}" download="{{$despesa->image}}">Baixar</a>
                                    </div>
                                </div>
                            </li>


                        </ul>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
