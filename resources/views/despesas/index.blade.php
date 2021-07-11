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

    <div class="header bg-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Saldo Atual</h5>
                                        <span class="h2 font-weight-bold mb-0">R$ {{number_format($saldo,2,',','.')}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span class="text-nowrap">Total Disponivel</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Gasto</h5>
                                        <span class="h2 font-weight-bold mb-0">R$ {{number_format($total_desp,2,',','.')}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i></span>
                                    <span class="text-nowrap">Total de gastos este mês</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Adto. Mês</h5>
                                        <span class="h2 font-weight-bold mb-0">R$ {{number_format($total_adto,2,',','.')}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-hand-holding-usd"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"><i class="fas fa-hand-holding-usd"></i></span>
                                    <span class="text-nowrap">Adiantamento este mês</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Reembolso</h5>
                                        <span class="h2 font-weight-bold mb-0">R$ {{number_format($reemb,2,',','.')}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                                    <span class="text-nowrap">Valor para reembolso</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Header -->

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">

                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('despesas.index')}}">Despesas</a></li>
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
    <!-- Modal -->
    <form action="{{ route('despesas.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="modal fade" id="ModalProjetos" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="modal-title-default">Cadastrar despesa!</h3>
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
                                                <input name="descricao" class="form-control" placeholder="Descricao" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                                                </div>
                                                <input name="valor" class="form-control" placeholder="Valor" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-picture">Imagem</label>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="image" >
                                                <label class="custom-file-label" for="input-picture">Selecione a Imagem</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo Despesa:</label>
                                            <select class="form-control" name="tipoDespesa">
                                                @foreach ($tipo_despesas as $item)
                                                    <option value="{{$item->id}}">{{$item->descricao}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Forma Pagamento:</label>
                                            <select class="form-control" name="formaPagamento">
                                                @foreach ($pagamento as $pag)
                                                    <option value="{{$pag["value"]}}">{{$pag["tipo"]}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Projeto:</label>
                                            <select class="form-control" name="projeto_id">
                                                @foreach ($projetos as $projeto)
                                                    <option value="{{$projeto->id}}">{{$projeto->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="date">Data</label>
                                                    <input class="form-control datepicker" name="data"  type="date" data-date-format="dd-mm-yyyy" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-excerpt">Observações:</label>
                                            <textarea name="obs" id="input-excerpt" cols="30" rows="2" class="form-control" placeholder="Observações" value=""></textarea>
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
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
                <h3 class="mb-0">Últimas Despesas</h3>
          </div>
          <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Imagem</th>
                            <th scope="col" class="sort" data-sort="name">Descrição</th>
                            <th scope="col" class="sort" data-sort="name">Valor</th>
                            <th scope="col" class="sort" data-sort="name">Projeto</th>
                            <th scope="col" class="sort" data-sort="name">Data</th>
                            <th scope="col" class="sort" data-sort="completion">Ações</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach($despesas as $despesa)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <a href="#" class="avatar rounded-circle mr-4">
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
                                    @foreach ($projetos as $projeto)
                                        @if($projeto->id == $despesa->projeto_id) {{$projeto->nome}}  @endif
                                    @endforeach
                                    <span class="mb-0 text-sm"> {{$despesa->projeto}}</span>
                                </div>
                                </td>
                                       <td>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm"> {{$despesa->data}}</span>
                                        </div>
                                       </td>

                                    </div>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a href="{{route('despesas.edit',$despesa->id)}}" class="dropdown-item">Editar</a>
                                            <a href="{{route('despesas.show',$despesa->id)}}" class="dropdown-item">Visualizar</a>
                                            <form action="{{route('despesas.destroy',$despesa->id)}}" method="post">
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
