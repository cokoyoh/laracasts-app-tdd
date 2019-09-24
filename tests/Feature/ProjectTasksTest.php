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

        $project = create(Project::class);

        $attributes = raw(Task::class, ['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
