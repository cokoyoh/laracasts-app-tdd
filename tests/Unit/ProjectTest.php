<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
         $project = create(Project::class);


         $this->assertEquals('/projects/'. $project->id, $project->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $project = create(Project::class);

        $this->assertInstanceOf(User::class, $project->owner);
    }

    /** @test */
    public function it_can_add_a_task()
    {
        $project = create(Project::class);

        $task = $project->addTask('Test Task');

        $this->assertCount(1, $project->tasks);

        $this->assertTrue($project->tasks->contains($task));
    }

    /** @test */
    public function it_can_invite_a_user()
    {
        $project = create(Project::class);

        $project->invite($user = create(User::class));

        $this->assertTrue($project->members->contains($user));
    }

    /** @test */
    public function it_can_access_the_last_five_activities()
    {
        $project = create(Project::class);

        create(Task::class, ['project_id' => $project->id], 6);

        $this->assertCount(7, $project->activity);

        $latestActivities = $project->activities(5);

        $this->assertEquals(5, $latestActivities->count());
    }
}

