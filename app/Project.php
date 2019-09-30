<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
    protected $guarded = ['id'];

    public $old = [];

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
        return $this->hasMany(Activity::class)->latest();
    }


    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges($description),
        ]);
    }

    private function activityChanges($description)
    {
        if ($description != 'updated') {
            return;
        }

        return [
            'before' => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
            'after' => Arr::except($this->getChanges(), 'updated_at')
        ];
    }
}
