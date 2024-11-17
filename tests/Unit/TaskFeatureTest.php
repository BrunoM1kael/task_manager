<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class TaskFeatureTest extends TestCase
{
    /** @test */
    public function a_user_can_view_tasks()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/task');

        $response->assertStatus(200);
        $response->assertSee('Tarefas');
    }
}
