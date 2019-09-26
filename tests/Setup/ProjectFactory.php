<?php


namespace Tests\Setup;


use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    protected $tasksCount = 0;
    protected $user;

    public function create()
    {
        $project = create(Project::class, [
            'owner_id' => $this->user ?? create(User::class)->id
        ]);

        create(Task::class, [
            'project_id' => $project->id
        ], $this->tasksCount);

        return $project;
    }

    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function ownedBy(User $user)
    {
        $this->user = $user;

        return $this;
    }
}
