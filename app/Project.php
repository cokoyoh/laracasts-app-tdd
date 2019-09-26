<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];

    public function path()
    {
        return "/projects/{$this->id}" ;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(['body' => $body]);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }


    public function recordActivity($activityType)
    {
        Activity::create([
            'project_id' => $this->id,
            'description' => $activityType
        ]);
    }
}
