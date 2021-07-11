@extends('layouts.app')

@section('title', 'Escola de Axies')

@section('content')
  @include('layouts.navbars.navbar')
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-inner--text"><strong>Sucesso!</strong> {{session('message')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!--Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">

                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('account.index')}}">Contas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista</li>
                        </ol>
                        </nav>
                    </div>

                    <div class="col-lg-6  text-right">

                        <a href="#" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#ModalProjetos">Inserir</a>


                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Cards de Informações -->
    <div class="container-fluid mt--6 ">
        <div class="header-body">                <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total SLP</h5>

                                    <span class="h2 font-weight-bold mb-0">{{$slp_total}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                <span class="text-nowrap">
                                    Valor em
                                    @if($coin == 'brl')R$@endif
                                    @if($coin == 'usd')US$@endif
                                    @if($coin == 'eur')€@endif
                                    {{number_format($coin_slp,2,',','.')}}
                                </span>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Média Total</h5>
                                    <span class="h2 font-weight-bold mb-0">R$ 0,00</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i></span>
                                <span class="text-nowrap">Média mensal de ganhos SLP</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total SLP Jogadores</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$total_slp_jogador}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-hand-holding-usd"></i>

                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-warning mr-2"><i class="fas fa-hand-holding-usd"></i></span>
                                <span class="text-nowrap">
                                    Valor em
                                    @if($coin == 'brl')R$@endif
                                    @if($coin == 'usd')US$@endif
                                    @if($coin == 'eur')€@endif
                                    {{number_format($coin_slp_jogador,2,',','.')}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total SLP Escola</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$total_slp_escola}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-warning mr-2"><i class="fas fa-hand-holding-usd"></i></span>
                                <span class="text-nowrap">
                                    Valor em
                                    @if($coin == 'brl')R$@endif
                                    @if($coin == 'usd')US$@endif
                                    @if($coin == 'eur')€@endif
                                    {{number_format($coin_slp_escola,2,',','.')}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabela de informações -->
        <div class="row">
            <div class="col">
                <div class="card mt-3">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center ">
                        <div class="col-lg-8">
                            <h3 class="mb-0">Contas</h3>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('config.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4  text-right">
                                        <select class="form-control" name="coin">
                                            <option value="usd" @if($coin == 'usd') selected @endif>USD</option>
                                            <option value="brl" @if($coin == 'brl') selected @endif>BRL</option>
                                            <option value="eur" @if($coin == 'eur') selected @endif>EUR</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2  text-right">
                                        <button type="submit" class="btn  btn-neutral">Gravar Preferência</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Nome do Time</th>
                                    <th scope="col" class="sort" data-sort="name">Ronin</th>
                                    <th scope="col" class="sort" data-sort="name">SLP Atual</th>
                                    <th scope="col" class="sort" data-sort="name">Próximo Saque</th>

                                    <th scope="col" class="sort" data-sort="completion">Ações</th>

                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach($players as $player)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                            <a href="{{route('account.show',$player->id)}}" class="avatar rounded-circle mr-3">
                                                <img alt="Image placeholder" src="../assets/img/theme/axie_logo.jpg">
                                            </a>
                                            <div class="media-body">
                                                <span class="mb-0  text-sm">{{$player['nome_time']}} </span>
                                            </div>
                                            </div>
                                        </th>

                                        <td>
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{$player['ronin']}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @foreach ($total_slp as $item )
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">@if($item['time_id'] == $player->id) {{$item['total_slp']}} @endif</span>
                                            </div>
                                            @endforeach

                                        </td>

                                        <td>
                                            @foreach ($total_slp as $item )
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">@if($item['time_id'] == $player->id) {{$item['data_saque']}} @endif</span>
                                            </div>
                                            @endforeach
                                        </td>

                                        </div>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a href="{{route('account.show',$player->id)}}" class="dropdown-item">Detalhes</a>

                                                    <a href="{{route('account.edit',$player->id)}}" class="dropdown-item">Editar</a>
                                                    <form action="{{route('account.destroy',$player->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    @if (isset($filters))
                        {{ $players->appends($filters)->links()}}
                    @else
                        {{ $players->links()}}
                    @endif
                </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footers.footer')
    </div>



          <!-- Modal Formulário de Cadastro -->
    <form action="{{ route('account.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="modal fade" id="ModalProjetos" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="modal-title-default">Cadastro do Time</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form role="form">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                                                </div>
                                                <input name="ronin" class="form-control" placeholder="Insira o endereço Ronin!" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                                                </div>
                                                <input name="nome_time" class="form-control" placeholder="Insira o nome do time!" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="date">Meta Mensal</label>
                                                    <input class="form-control" name="meta_mensal"  type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="date">% SLP Escola</label>
                                                     <select class="form-control" name="slp_escola">
                                                        <option value="0.1">10%</option>
                                                        <option value="0.2">20%</option>
                                                        <option value="0.3">30%</option>
                                                        <option value="0.4">40%</option>
                                                        <option value="0.5">50%</option>
                                                        <option value="0.6">60%</option>
                                                        <option value="0.7">70%</option>
                                                        <option value="0.8">80%</option>
                                                        <option value="0.9">90%</option>
                                                        <option value="1.0">100%</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Fechar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>





@endsection
