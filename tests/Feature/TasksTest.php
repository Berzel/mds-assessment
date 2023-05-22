<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_the_application_has_a_tasks_index_page(): void
    {
        $response = $this->actingAs(User::factory()->create())->get(route('tasks.index'));

        $response->assertOk();
    }

    /**
     * A logged in user can create a task
     */
    public function test_a_user_can_create_a_task()
    {
        $this->assertDatabaseCount('tasks', 0);

        $data = Task::factory()->make()->toArray();
        $response = $this->actingAs(User::factory()->create())->post(route('tasks.store'), $data);

        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', $data);

        $task = Task::first();
        $response->assertRedirect(route('tasks.show', ['task' => $task]));
    }
}
