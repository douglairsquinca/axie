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
                            <li class="breadcrumb-item"><a href="{{route('despesas.index')}}">Despesas</a></li>
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
                <h3 class="mb-0">Últimas Despesas</h3>
          </div>
          <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Funcionário</th>
                            <th scope="col" class="sort" data-sort="name">Saldo Atual</th>
                            <th scope="col" class="sort" data-sort="completion">Ações</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach($usuarios as $user)
                            <tr>
                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm"> {{$user->name}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm"> {{$user->name}}</span>
                                    </div>
                                </td>
                                <td class="text-right">

                                        <div class="row">
                                            <a href="{{ route('relatorios.searchMonth', $user->id)}}">
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
