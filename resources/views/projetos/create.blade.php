@extends('admin.layouts.app')

@section('title', 'Criação do Post')

@section('content')
    <h1>Cadastrar Novo Projeto</h1>

    <form action="{{ route('projetos.store')}}" method="post">
        @include('projetos._partials.form')
    </form>

@endsection
