<?php


namespace Tests\Feature;


use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_projects()
    {
        $project = create(Project::class);

        $this->get('projects')->assertRedirect('login');

        $this->get('projects/create')->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');

        $this->post('projects', $project->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_projects()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General note here.'
        ];

        $response = $this->post('projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description)
            ->assertSee($project->notes);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project =  create(Project::class, [
            'owner_id' => auth()->id()
        ]);

        $this->patch($project->path(), [
            'notes' => 'Changed'
        ])->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', [
            'notes' => 'Changed'
        ]);
    }

    /** @test */
    public function a_user_can_only_update_their_project()
    {
        $this->signIn();

        $project = create(Project::class);

        $this->patch($project->path(), [
            'notes' => 'changed'
        ])->assertStatus(403);

        $this->assertDatabaseMissing('projects', ['notes' => 'changed']);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project =  create(Project::class, [
            'owner_id' => auth()->id()
        ]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        $project =  create(Project::class);

        $this->get($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw(['title' => '']);

        $this->post('projects', $attributes)
            ->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->post('projects', $attributes)
            ->assertSessionHasErrors('description');

    }
}
