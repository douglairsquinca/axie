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
                            <li class="breadcrumb-item"><a href="{{route('despesas.index')}}">Despesas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                        </nav>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <form action="{{route('despesas.update',$despesa->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <!-- Card image -->
                        <img class="card-img-top" src="{{ url("storage/{$despesa->image}")}}" alt="">
                        <!-- Card body -->
                        <div class="card-body">
                            <h5>Descrição:</h5>
                            <input name="descricao" class="form-control" placeholder="Descricao" type="text" value="{{$despesa->descricao}}">
                            <label class="form-control-label" for="date">Data</label>
                            <input class="form-control datepicker" name="data"  type="date" data-date-format="dd-mm-yyyy" value="{{$despesa->data}}">
                                                                    
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
        
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <!-- Title -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="h3 mb-0">Detalhes da Despesa</h5>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <button type="submit" class="btn btn-sm btn-neutral">Alterar Despesa</button>             
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
                                            <input type="text" class="form-control" name="valor" value="{{$despesa->valor}}">                                   
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
                                            <h5>Projeto:</h5>
                                            <select class="form-control" name="projeto_id">  
                                                @foreach ($projetos as $projeto)                                       
                                                    <option value="{{$projeto->id}}"@if($projeto->id == $despesa->projeto_id) selected @endif>{{$projeto->nome}}</option>
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
                                            
                                                <i class="ni ni-credit-card"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Forma de Pagamento:</h5>
                                            <select class="form-control" name="formaPagamento">  
                                                @foreach ($pagamento as $pag)                                       
                                                    <option value="{{$pag["value"]}}"@if($pag["value"] == $despesa->formaPagamento) selected @endif>{{$pag["tipo"]}}</option>
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
                                            <select class="form-control" name="formaPagamento">  
                                                @foreach ($tipo_despesas as $tipo)                                       
                                                    <option value="{{$tipo->id}}"@if($tipo->id == $despesa->tipoDespesa) selected @endif>{{$tipo->descricao}}</option>
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
                                                <i class="ni ni-single-copy-04"></i>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <h5>Observação:</h5>
                                            <textarea name="obs" cols="30" rows="2" class="form-control" placeholder="Observações">{{$despesa->obs}}</textarea>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar -->
                                            <a href="#" class="avatar rounded-circle">
                                                <i class="ni ni-image"></i>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <label class="form-control-label" for="input-picture">Imagem</label>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="image" >
                                                <label class="custom-file-label" for="input-picture">Selecione a Imagem</label>
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