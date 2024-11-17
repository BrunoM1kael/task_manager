<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5)->create();

        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Condição para verificar se já existe
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        );
    }
}
