<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\TaskFormRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $orderBy = $request->input('order_by', 'created_at');
        $orderDirection = $request->input('order_direction', 'asc');
        $message = $request->session()->get('message');

        $perPage = $request->input('per_page', 10); // Padrão para 10 itens por página

        // Define a query com base no papel do usuário
        $tasksQuery = Auth::user()->role === 'admin'
            ? Task::query()
            : Task::where('user_id', Auth::id());

        // Aplica o filtro de status, se fornecido
        if ($status) {
            $tasksQuery->where('status', $status);
        }

        // Ordena as tarefas
        $tasksQuery->orderBy($orderBy, $orderDirection);

        // Verifica se a opção 'Todos' foi selecionada
        if ($perPage == 'all') {
            // Retorna todos os itens sem paginação
            $allTasks = $tasksQuery->get();
            $tasks = new LengthAwarePaginator(
                $allTasks,
                $allTasks->count(),
                $allTasks->count(), // Número de itens por página é o total
                1, // Sempre na página 1
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } else {
            // Paginação normal
            $tasks = $tasksQuery->paginate($perPage);
        }

        // Retorna a view com as tarefas, a mensagem e a direção da ordenação
        return view('tasks.index', compact('tasks', 'message', 'orderDirection'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskFormRequest $request)
    {
        $user_id = Auth::user()->getAuthIdentifier();
        Task::create([
            'title' => $request->title,
            'status' => $request->status,
            'description' => $request->description,
            'user_id' => $user_id
        ]);
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Task $task)
    {
        return view('tasks.edit', compact("task"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskFormRequest $request, Task $task)
    {
        $task->title = $request->input('title');
        $task->status = $request->input('status');
        $task->description = $request->input('description');
        $task->save();
        $message = "Atualização feita com sucesso";

        return redirect()->route('task.index', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        $message = "Tarefa deletada com sucesso";

        return redirect()->route('task.index', compact('message'));
    }
}
