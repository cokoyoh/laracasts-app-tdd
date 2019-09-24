<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = create(Project::class);

        $this->post($project->path() . '/tasks', ['body' => 'Task Test'])
            ->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_can_add_tasks()
    {
        $this->signIn();

        $project = create(Project::class);

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'Test task.']);

        $this->get($project->path())
            ->assertSee('Test task.');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);

        $attributes = raw(Task::class, ['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
