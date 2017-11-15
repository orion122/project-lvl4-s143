<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'status', 'creator', 'assignedTo'
    ];


    public function owner()
    {
        return $this->belongsTo('\App\User', 'creator', 'id');
    }


    public function assigned()
    {
        return $this->belongsTo('\App\User', 'assignedTo', 'id');
    }


    public function taskStatus()
    {
        return $this->hasOne('\App\TaskStatus', 'id', 'status');
    }


    public function tags()
    {
        return $this->belongsToMany('\App\Tag', 'task_tags');
    }
}
