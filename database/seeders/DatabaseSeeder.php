<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->has(Task::factory()->count(60))
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password'
            ]);
    }
}
