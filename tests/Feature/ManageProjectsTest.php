<?php


namespace Tests\Feature;


use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
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

        $this->get( $project->path() .'/edit')->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');

        $this->post('projects', $project->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_projects()
    {
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $this->followingRedirects()->post('projects', $attributes = raw(Project::class))
            ->assertSee($attributes['title'])
            ->assertSee($attributes['notes'])
            ->assertSee($attributes['description']);
    }

    /** @test */
    public function tasks_can_be_included_as_part_of_a_new_project_creation()
    {
        $this->signIn();

        $attributes = raw(Project::class);

        $attributes['tasks'] = [
            ['body' => 'Task 1'],
            ['body' => 'Task 1']
        ];

        $this->post('/projects', $attributes);

        $this->assertCount(2, Project::first()->tasks);
    }

    /** @test */
    public function a_user_can_see_all_projects_they_have_been_invited_to_on_their_dashboard()
    {
        $user = $this->signIn();

        $project = tap(ProjectFactory::create())->invite($user);

        $this->get('/projects')
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(),  $attributes = ['notes' => 'Changed']);

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function unauthorised_users_cannot_delete_projects()
    {
        $project = ProjectFactory::create();

        $this->delete($project->path())
            ->assertRedirect('login');

        $user = $this->signIn();

        $this->delete($project->path())->assertStatus(403);

        $project->invite($user);

        $this->actingAs($user)->delete($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_user_can_delete_a_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test */
    public function a_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(),  $attributes = ['title' => 'Changed', 'description' => 'Changed', 'notes' => 'Changed'])
            ->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_only_update_their_project()
    {
        $this->signIn();

        $project = create(Project::class);

        $this->patch($project->path(), ['notes' => 'changed'])
            ->assertStatus(403);

        $this->get($project->path() .'/edit')
            ->assertStatus(200);

        $this->assertDatabaseMissing('projects', ['notes' => 'changed']);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $project =  ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
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
