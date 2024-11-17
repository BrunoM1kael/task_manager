@extends('layouts.app')

@section('cabecalho')
    @include('layouts.cabecalho', ['title' => 'Criação de Tarefas', 'rote' => 'task.index'])
@endsection

@section('content')

@include('layouts.errors', ['errors' => $errors])

    <div class="form-table">
        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="title" placeholder="Digite o título" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select custom-select" name="status" aria-label="Default select example">
                    <option value="" disabled>Escolha o status da tarefa</option>
                    <option value="Pendente" {{ old('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="Em andamento" {{ old('status') == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                    <option value="Concluída" {{ old('status') == 'Concluída' ? 'selected' : '' }}>Concluída</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Digite a descrição"value="{{ old('title') }}"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection
