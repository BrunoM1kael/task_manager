@extends('layouts.app')

@section('cabecalho')
    @include('layouts.cabecalho', ['title' => 'Edição de Tarefas', 'rote' => 'task.index'])
@endsection

@section('title', 'Criação de Tarefas')
@section('content')

@include('layouts.errors', ['errors' => $errors])

    <div class="form-table">
        <form action="{{ route('task.update', $task->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="title" value="{{ $task->title }}">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select custom-select" name="status" aria-label="Default select example">
                    <option value="" disabled>Escolha o status da tarefa</option>
                    <option value="Pendente" {{ old('status') == 'Pendente' ? 'selected' : $task->status }}>Pendente
                    </option>
                    <option value="Em andamento" {{ old('status') == 'Em andamento' ? 'selected' : $task->status }}>Em
                        andamento</option>
                    <option value="Concluída" {{ old('status') == 'Concluída' ? 'selected' : $task->status }}>Concluída
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Digite a descrição">{{ $task->description }}</textarea>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Criação:</label>
                    <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i') }}">
                </div>
                <div class="col">
                    <label class="form-label">Última atualização:</label>
                    <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($task->updated_at)->format('d/m/Y H:i') }}">
                </div>
            </div>

            <div style="padding: 20px 0 ">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection
