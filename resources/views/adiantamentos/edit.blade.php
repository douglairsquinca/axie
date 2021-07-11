@extends('layouts.app')

@section('title', 'Editar de Despesas')


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
                            <li class="breadcrumb-item"><a href="{{route('adiantamentos.index')}}">Adiantamentos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                        </nav>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <form action="{{route('adiantamentos.update',$adto->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <!-- Title -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="h3 mb-0">Detalhes do Adiantamento</h5>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <button type="submit" class="btn btn-sm btn-neutral">Alterar</button>
                                </div>
                            </div>
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
                                        <div class="col-md-3">
                                            <h5>Valor:</h5>
                                            <input type="text" class="form-control" name="valor" value="{{$adto->valor}}">
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
                                        <div class="col-md-4">
                                            <h5>Funcionário:</h5>
                                            <select class="form-control" disabled name="user_id">
                                                @foreach ($users as $user)
                                                    <option  value="{{$user->id}}"@if($user->id == $adto->user_id) selected @endif>{{$user->name}}</option>
                                                @endforeach
                                            </select>
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
                                        <div class="col-md-4">
                                            <h5>Tipo de Despesa:</h5>
                                            <input class="form-control datepicker" name="data"  type="date" data-date-format="dd-mm-yyyy" value="{{$adto->data}}">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
