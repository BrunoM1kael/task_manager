@extends('layouts.app')

@section('cabecalho')
    @include('layouts.cabecalho', ['title' => 'Troca de senha', 'rote' => 'task.index'])
@endsection

@section('title', 'Criação de Tarefas')
@section('content')

    @include('layouts.errors', ['errors' => $errors])


    <div class="container containerTabela justify-content-center">
        <div class="container">
            <form method="post" action="{{route('user.changedpassword')}}" autocomplete="off">
                @csrf
                <div class="form-group mb-3">
                    <strong>Email:</strong>
                    <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <strong>Senha Atual:</strong>
                    <input type="password" name="password" id="password" required min="1" class="form-control"
                        autocomplete="new-password">
                </div>
                <div class="form-group mb-3">
                    <strong>Nova Senha:</strong>
                    <input type="password" name="newpassword" id="newpassword" required min="1" class="form-control"
                        autocomplete="off">
                </div>
                <div class="form-group mb-3">
                    <strong>Confirmação Nova Senha:</strong>
                    <input type="password" name="password_confirmation" id="password_confirmation" required min="1"
                        class="form-control" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
            </form>
        </div>
    </div>
@endsection
