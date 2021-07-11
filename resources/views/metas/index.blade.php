@extends('layouts.app')

@section('title', 'Escola de Axies')

@section('content')
  @include('layouts.navbars.navbar')
    <!--Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-11 col-7">

                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('account.index')}}">Axies</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista</li>
                        </ol>
                        </nav>
                    </div>
                    <div class="col-lg-1 col-1 text-right">
                        <select class="form-control" name="coin">
                            <option value="usd">USD</option>                            
                            <option value="brl">BRL</option>                            
                            <option value="eur">EUR</option>                            
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
     <!-- Page content -->
  <div class="container-fluid mt--6">
        <div class="header-body">                <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total SLP</h5>
                                   
                                    <span class="h2 font-weight-bold mb-0">R$ 0,00</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                     <span class="text-nowrap">Tota mensal de ganhos SLP</span>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Jogadores</h5>
                                    <span class="h2 font-weight-bold mb-0">R$ 0,00</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-warning mr-2"><i class="fas fa-hand-holding-usd"></i></span>
                                 <span class="text-nowrap">Valor em reais data atual!</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Escola</h5>
                                    <span class="h2 font-weight-bold mb-0">R$ 0,00</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-warning mr-2"><i class="fas fa-hand-holding-usd"></i></span>
                                <span class="text-nowrap">Valor em reais data atual!</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
        <div class="row">
            <div class="col ">
                <div class="card mt-3 ">
                <!-- Card header -->
                <div class="card-header border-0">
                        <h3 class="mb-0">Informações detalhadas</h3>
                </div>
                <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Time</th>
                                    <th scope="col" class="sort" data-sort="name">SLP Diário</th>
                                    <th scope="col" class="sort" data-sort="name">Média SLP</th>
                                    <th scope="col" class="sort" data-sort="name">Total SLP</th>
                            
                            
                                    <th scope="col" class="sort" data-sort="completion">Ações</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach($meta_diaria as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm">{{$item['nome_time']}} </span>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{$item['slp_diario']}} </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{$item['total_slp'] / $item['qtd_dias']}} </span>
                                            </div>
                                        </td>
                                
                                            <td>
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm">{{$item['total_slp']}} </span>
                                                </div>
                                            </td>

                                            </div>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a href="" class="dropdown-item">Editar</a>
                                                    <a href="" class="dropdown-item">Visualizar</a>
                                                    <form action="" method="post">
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
                    {{-- @if (isset($filters))
                        {{ $despesas->appends($filters)->links()}}
                    @else
                        {{ $despesas->links()}}
                    @endif --}}
                </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footers.footer')
  </div>
       
      

          <!-- Modal -->
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
                                        <div class="form-group">
                                            <label>% de ganho da Escola:</label>
                                            <select class="form-control" name="slp_escola">                                                
                                                <option value="10">10%</option>
                                                <option value="20">20%</option>
                                                <option value="30">30%</option>
                                                <option value="40">40%</option>
                                                <option value="50">50%</option>
                                                <option value="60">60%</option>
                                                <option value="70">70%</option>
                                                <option value="80">80%</option>
                                                <option value="90">90%</option>
                                                <option value="100">100%</option>                                                
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="date">Meta Mensal</label>
                                                    <input class="form-control" name="meta_mensal"  type="text">
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
