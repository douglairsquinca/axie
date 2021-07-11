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
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
                <div class="col-lg-8">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <!-- Title -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="h3 mb-0">Editando informações do Time</h5>
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
                                            <a href="#" class="avatar rounded-circle mr-1">
                                                <img alt="Image placeholder" src="/assets/img/theme/ronin.jpg">
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                             <input name="ronin" class="form-control" type="text" value="{{$time->ronin}}">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar -->
                                            <a href="#" class="avatar rounded-circle ">
                                                <img alt="Image placeholder" src="/assets/img/theme/axie_logo.jpg">
                                              </a>
                                        </div>
                                        <div class="col-md-4">
                                            <input name="nome_time" class="form-control" type="text" value="{{$time->nome_time}}">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="date">Meta Mensal</label>
                                                <input class="form-control" name="meta_mensal"  type="text" value="{{$time->meta_mensal}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="date">% SLP Escola</label>
                                                 <select class="form-control" name="slp_escola" value="{{$time->slp_escola}}">
                                                    <option value="0.10"{{($time->slp_escola == '0.10' ? 'selected' : '')}}>10%</option>
                                                    <option value="0.20"{{($time->slp_escola == '0.20' ? 'selected' : '')}}>20%</option>
                                                    <option value="0.30"{{($time->slp_escola == '0.30' ? 'selected' : '')}}>30%</option>
                                                    <option value="0.40"{{($time->slp_escola == '0.40' ? 'selected' : '')}}>40%</option>
                                                    <option value="0.50"{{($time->slp_escola == '0.50' ? 'selected' : '')}}>50%</option>
                                                    <option value="0.60"{{($time->slp_escola == '0.60' ? 'selected' : '')}}>60%</option>
                                                    <option value="0.70"{{($time->slp_escola == '0.70' ? 'selected' : '')}}>70%</option>
                                                    <option value="0.80"{{($time->slp_escola == '0.80' ? 'selected' : '')}}>80%</option>
                                                    <option value="0.90"{{($time->slp_escola == '0.90' ? 'selected' : '')}}>90%</option>
                                                    <option value="1.00"{{($time->slp_escola == '1.00' ? 'selected' : '')}}>100%</option>
                                                </select>
                                            </div>
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

