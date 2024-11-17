<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    /** @test */
    public function it_can_create_a_task()
    {
        $task = Task::factory()->create();

        $this->assertDatabaseHas('tasks', ['title' => 'Nova Tarefa']);
    }
}
