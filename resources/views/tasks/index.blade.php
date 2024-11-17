@extends('layouts.app')

@section('title', 'Tarefas')

@section('content')
    @include('layouts.message', ['message' => $message])

    @if ($tasks->isEmpty())
        <div class="text-center text-white">
            <h4>Você ainda não tem tarefas!</h4>
            <a href="{{ route('task.create') }}" class="btn btn-success">Crie sua primeira tarefa</a>
        </div>
    @else
        <div class="d-flex justify-content-end mb-3" style="padding: 0 0 20px">
            <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('task.create') }}'">
                Nova Tarefa
            </button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form method="GET" action="{{ route('task.index') }}" class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"> </i> Filtrar</button>

                <select name="status" class="form-select bg-dark text-light">
                    <option value="">Todos os Status</option>
                    <option value="Pendente" {{ request('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="Em andamento" {{ request('status') == 'Em andamento' ? 'selected' : '' }}>Em andamento
                    </option>
                    <option value="Concluída" {{ request('status') == 'Concluída' ? 'selected' : '' }}>Concluída</option>
                </select>


                <select name="order_by" class="form-select bg-dark text-light">
                    <option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>Data de Criação
                    </option>
                    <option value="updated_at" {{ request('order_by') == 'updated_at' ? 'selected' : '' }}>Data de
                        Atualização</option>
                </select>

                <select name="order_direction" class="form-select bg-dark text-light">
                    <option value="asc" {{ request('order_direction') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                    <option value="desc" {{ request('order_direction') == 'desc' ? 'selected' : '' }}>Descendente</option>
                </select>
            </form>

            <form method="GET" action="{{ url()->current() }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <select name="per_page" class="form-select bg-dark text-light" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10 itens</option>
                            <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25 itens</option>
                            <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100 itens</option>
                            <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Todos</option>
                        </select>
                    </div>
                </div>
            </form>
            
        </div>


        <div class="row d-flex justify-content-center mt-3 containerTable bg-gray-900 text-white p-4 rounded-lg shadow-lg">

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Status</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">
                                @if ($orderDirection == 'desc')
                                    {{ $tasks->total() - $tasks->perPage() * ($tasks->currentPage() - 1) - $loop->iteration + 1 }}
                                @else
                                    {{ $loop->iteration + $tasks->perPage() * ($tasks->currentPage() - 1) }}
                                @endif
                            </th>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ Str::limit($task->description, 120) }}</td>
                            <td class="action-column d-flex gap-2">
                                <a class="btn btn-primary" href="{{ route('task.edit', $task->id) }}" role="button">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $task->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <div class="modal fade text-white" id="confirmDeleteModal{{ $task->id }}"
                                    tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $task->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel{{ $task->id }}">
                                                    Confirmação de Exclusão
                                                </h5>
                                                <button type="button" class="btn-close text-light" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Você realmente deseja excluir essa tarefa?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Não</button>
                                                <form method="POST" action="{{ route('task.destroy', $task->id) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Sim</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    @endif
    </div>
    @if ($tasks->count() < 1)
        <p>Sem tarefas para exibir.</p>
    @else
        <div class="pagination-container d-flex justify-content-center bg-dark">
            @if (request('per_page') != 'all')
                {{ $tasks->appends(request()->query())->links('pagination::bootstrap-5') }}
            @endif
        </div>
    @endif

@endsection
