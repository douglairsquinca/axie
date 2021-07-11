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
                            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Funcionários</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista</li>
                        </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-neutral">Novo</a>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Todos Funcionários</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Nome</th>
                                    <th scope="col" class="sort" data-sort="email">Email</th>
                                    <th scope="col" class="sort" data-sort="permissoes">Permissões</th>
                                    <th scope="col" class="sort" data-sort="acao">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm"><td>{{ $user->name }}</td></span>
                                        </div>

                                        <td>{{ $user->email }}</td>
                                        <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-neutral" href="{{ route('users.edit',$user->id) }}">Editar</a>

                                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! $data->render() !!}



@endsection
