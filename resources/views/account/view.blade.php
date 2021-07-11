@extends('layouts.app')

@section('title', 'Escola de Axies')

@section('content')
@include('layouts.navbars.navbar')
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
                            <li class="breadcrumb-item active" aria-current="page">Detalhe</li>
                        </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Page content -->
    <div class="container-fluid mt--6 ">
           <form action="{{route('account.update',$time->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <!-- Title -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="h3 mb-0">Informações detalhadas do Time</h5>
                                </div>

                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- List group -->
                            <ul class="list-group list-group-flush list my--3">
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <!-- Avatar -->

                                                    <a href="#" class="avatar rounded-circle mr-1">
                                                        <img alt="Image placeholder" src="../assets/img/theme/ronin.jpg">
                                                    </a>
                                                </div>
                                                <div class="col-md-8">
                                                    <span name="ronin" class="form-control">{{$time->ronin}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <!-- Avatar -->
                                                    <a href="#" class="avatar rounded-circle ">
                                                        <img alt="Image placeholder" src="../assets/img/theme/axie_logo.jpg">
                                                      </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <span name="nome_time" class="form-control" type="text">{{$time->nome_time}}</span>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Avatar -->
                                                    <a href="#" class="avatar rounded-circle ">
                                                        <img alt="Image placeholder" src="../assets/img/theme/slp.jpg">
                                                      </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <span name="total_slp" class="" type="text">{{$saldo_slp}} - total</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label" for="date">Meta Mensal</label>
                                                <span class="form-control" name="meta_mensal">{{$time->meta_mensal}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label" for="date">% SLP Escola</label>
                                                <span class="form-control" name="meta_mensal">{{$time->slp_escola}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-control-label" for="date">% SLP Jogador</label>
                                                <span class="form-control" name="meta_mensal">{{$time->slp_aluno}}</span>
                                            </div>
                                        </div>
                                        @foreach ($playerList as $item )
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="date">Rank Geral</label>
                                                    <span class="form-control" name="meta_mensal">{{$item['items'][0]['rank']}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="date">Rank Troféus</label>
                                                    <span class="form-control" name="meta_mensal">{{$item['items'][0]['elo']}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="date">SLP/Vitória Arena</label>
                                                    <span class="form-control" name="meta_mensal">{{$slp_ganho}} - SLP</span>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
              <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Estatisticas do Time</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Farm SLP Diário</th>
                                    <th scope="col" class="sort" data-sort="name">Vitórias</th>
                                    <th scope="col" class="sort" data-sort="name">Empates</th>
                                    <th scope="col" class="sort" data-sort="name">Derrotas</th>
                                    <th scope="col" class="sort" data-sort="name">Meta Realizada</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <tr>
                                    <td>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm"></span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{$item['items'][0]['win_total']}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{$item['items'][0]['draw_total']}}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{$item['items'][0]['lose_total']}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{number_format($meta, 2, '.', '')}} %</span>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                     <!-- Card footer -->
                    <div class="card-footer py-4">
                        {{-- @if (isset($filters))
                            {{ $playerList->appends($filters)->links()}}
                        @else
                            {{ $playerList->links()}}
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

