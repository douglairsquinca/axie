@extends('layouts.app')

@section('title', 'Saque de SLP')


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
                            <li class="breadcrumb-item"><a href="{{route('financeiro.index')}}">Saques</a></li>
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
    <form action="{{ route('financeiro.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="modal fade" id="ModalProjetos" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="modal-title-default">Informativo de Saque!</h3>
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
                                                <input name="qtd_slp" class="form-control" placeholder="Quantida de SLP" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Time:</label>
                                            <select class="form-control" name="time_id">
                                                 @foreach ($times as $time)
                                                     <option value="{{$time->id}}">{{$time->nome_time}}</option>
                                                 @endforeach}}
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="date">Data de Saque</label>
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
                <h3 class="mb-0">Últimos Saques</h3>
          </div>
          <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Time</th>
                            <th scope="col" class="sort" data-sort="name">SLP</th>
                            <th scope="col" class="sort" data-sort="name">Data</th>
                            <th scope="col" class="sort" data-sort="completion">Ações</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($saques as $saque)
                            <tr>
                                <td>
                                    <div class="media-body">
                                        @foreach ($times as $time)
                                            <span class="mb-0 text-sm">@if($time->id == $saque->time_id) {{$time->nome_time}} @endif </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">{{$saque->qtd_slp}} </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">{{$saque->data}} </span>
                                    </div>
                                </td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a href="{{route('financeiro.edit',$saque->id)}}" class="dropdown-item">Editar</a>

                                            <form action="{{route('financeiro.destroy', $saque->id)}}" method="post">
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
                {{ $adto->appends($filters)->links()}}
            @else
                {{ $adto->links()}}
            @endif --}}
          </div>
        </div>
      </div>
    </div>


    <!-- Footer -->
    @include('layouts.footers.footer')
  </div>

@endsection
