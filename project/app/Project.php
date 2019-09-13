<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable =  [
        'title', 'description', 'owner_id'
    ];

    // protected $guarded = []; // allow all fields to be mass-assigned

    public function tasks() 
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task) 
    {
        $this->tasks()->create($task);

        // return Task::create([
        //     'project_id' => $this->id,
        //     'description' => $description            
        // ]);
        
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
