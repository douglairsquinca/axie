@extends('layouts.app')

@section('title', 'Listagem de Despesas')


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


  <!-- Header -->

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">

                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('relatorios.index')}}">Relatório</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista</li>
                        </ol>
                        </nav>
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
                <form action="{{route('relatorios.searchMonth',$user_id)}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">Últimas Despesas</h3>
                        </div>
                        <!-- Toggler -->

                        <div class="col-lg-3 ">
                            <input class="form-control" type="month" value="" name="mes">
                        </div>

                        <div class="col-lg-1  text-right">
                            <button type="submit" class="btn btn-sm btn-neutral">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-lg-3">
                        <h3 class="mb-0">Saldo Anterior</h3>
                        R$ {{number_format($saldo_ant,2,',','.')}}
                    </div>
                    <div class="col-lg-3">
                        <h3 class="mb-0">Adiantamento</h3>
                        R$ {{number_format($total_adto,2,',','.')}}
                    </div>
                    <div class="col-lg-3">
                        <h3 class="mb-0">Despesas</h3>
                        R$ {{number_format($total_desp,2,',','.')}}
                    </div>
                    <div class="col-lg-3">
                        <h3 class="mb-0">Saldo Atual</h3>
                        R$ {{number_format($saldo,2,',','.')}}
                    </div>

                </div>
            </div>
          <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Imagem</th>
                            <th scope="col" class="sort" data-sort="name">Descrição</th>
                            <th scope="col" class="sort" data-sort="name">Valor</th>
                            <th scope="col" class="sort" data-sort="name">Tipo Despesa</th>
                            <th scope="col" class="sort" data-sort="name">Forma Pagamento</th>
                            <th scope="col" class="sort" data-sort="name">Data</th>
                            <th scope="col" class="sort" data-sort="name">Projeto</th>
                            <th scope="col" class="sort" data-sort="name">Ações</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach($despesas as $despesa)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <a class="avatar rounded-circle mr-4">
                                                <img src="{{ url("storage/{$despesa->image}")}}">
                                            </a>
                                        </div>
                                    </div>
                                </th>
                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm"> {{$despesa->descricao}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm"> {{$despesa->valor}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        @foreach ($tipo_despesas as $tipo)
                                            @if($tipo->id == $despesa->projeto_id) {{$tipo->descricao}}  @endif
                                        @endforeach
                                        <span class="mb-0 text-sm"> </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            @foreach ($pagamento as $pag)
                                                @if($pag["value"] == $despesa->projeto_id) {{$pag["tipo"]}}  @endif
                                            @endforeach
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm"> {{\Carbon\Carbon::parse($despesa->data)->format('d/m/Y')}}</span>
                                    </div>
                                </td>

                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            @foreach ($projetos as $projeto)
                                                @if($projeto->id == $despesa->projeto_id) {{$projeto->nome}}  @endif
                                            @endforeach
                                        </span>
                                    </div>
                                <td>

                                <td>
                                    <div class="row">
                                        <a href="{{ route('relatorios.show',$despesa->id)}}">
                                            <button class="btn btn-icon btn-primary" type="button">
                                                <span class="btn-inner--icon"><i class="fas fa-users-cog"></i></span>
                                                <span class="btn-inner--text">Visualizar</span>
                                            </button>
                                        </a>
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
                {{ $despesas->appends($filters)->links()}}
            @else
                {{ $despesas->links()}}
            @endif
          </div>
        </div>
      </div>
    </div>


    <!-- Footer -->
    @include('layouts.footers.footer')
  </div>

@endsection
