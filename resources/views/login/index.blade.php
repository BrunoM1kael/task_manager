@extends('layouts.app')

@section('content')

    @include('layouts.errors', ['errors' => $errors])
    
    @include('layouts.message', ['message' => $message])

    <div class="row d-flex justify-content-center mt-4">
        <form method="post" style="width: 50%;">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" required value="{{ old('email')}}">
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" id="password" required min="1" class="form-control">
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-secondary"
                    onclick="window.location.href='{{ route('user.create') }}'">
                    Registar-se
                </button>
                <button type="submit" class="btn btn-primary" onclick="window.location.href='{{ route('login') }}'">
                    Entrar
                </button>
            </div>
        </form>
    </div>

@endsection
