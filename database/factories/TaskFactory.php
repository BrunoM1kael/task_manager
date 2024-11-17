<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Pendente', 'Em andamento', 'Concluída']),
            'description' => $this->faker->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
