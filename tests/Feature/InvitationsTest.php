<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function members_of_a_project_who_are_not_the_project_owner_may_not_invite_users()
    {
        $project = ProjectFactory::create();

        $randomUser = create(User::class);

        $this->actingAs($randomUser)
            ->post($project->path() . '/invitations', ['email' => 'someuser@example.com'])
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $john = create(User::class);

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => $john->email
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($john));
    }

    /** @test */
    public function the_invited_email_must_be_a_registered_member_of_birdboard()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'notauser@example.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have a Birdboard account.'
            ]);
    }

    /** @test */
    public function invited_users_may_update_project_details()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = create(User::class));

        $this->signIn($newUser);

        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
