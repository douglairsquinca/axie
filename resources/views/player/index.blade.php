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
                            <li class="breadcrumb-item"><a href="{{route('player.index')}}">Jogador</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista</li>
                        </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="#" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#ModalProjetos">Novo</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
                <h3 class="mb-0">Jogador</h3>
          </div>
           <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Nome do Jogador</th>
                            <th scope="col" class="sort" data-sort="name">Ronin</th>
                            <th scope="col" class="sort" data-sort="name">Telegram</th>
                            <th scope="col" class="sort" data-sort="name">Time</th>
                            <th scope="col" class="sort" data-sort="name">Meta Mensal</th>
                       
                            <th scope="col" class="sort" data-sort="completion">Ações</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                  
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
                                <h3 class="modal-title" id="modal-title-default">Cadastro do Jogador</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form role="form">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                                </div>
                                                <input name="ronin" class="form-control" placeholder="Insira o nome do Jogador!" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                                </div>
                                                <input name="ronin" class="form-control" placeholder="Insira o endereço Ronin!" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                                </div>
                                                <input name="nome_time" class="form-control" placeholder="Insira o Telegram do Jogador!" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Times Disponíveis</label>
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
