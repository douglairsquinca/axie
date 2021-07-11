@extends('layouts.app')

@section('title', 'Editar Tipo')

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
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('tipo_despesas.index')}}">Tipo Despesas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$tipoDespesas->descricao}}</li>
                        </ol>
                    </nav>
                </div>            
            </div>
        </div>
        
    </div>
</div>
<div class="container-fluid mt--6">       
    <div class="row">
        <div class="col">       
          
                <div class="card mb-4">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Edição</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form action="{{ route('tipo_despesas.update', $tipoDespesas->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Descrição:</label>
                                        <input type="text" class="form-control" name="descricao" value="{{$tipoDespesas->descricao}}">
                                    </div>
                                </div>        
                                    
                            </div>   
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-icon btn-3 btn-primary" type="submit">
                                        <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>                    
                                        <span class="btn-inner--text">Editar</span>                    
                                    </button>                                    
                                </div>                
                            </div> 
                        </form>
                        
                    </div>
                </div>            
        </div>    
    </div>
</div>
@endsection

