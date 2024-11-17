@extends('layouts.app')

@section('cabecalho')
    @include('layouts.cabecalho', ['title' => 'Cadastro', 'rote' => 'login'])
@endsection

@section('content')
@include('layouts.errors', ['errors' => $errors])

    <div class="form-table">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" min="1" class="form-control">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection
