<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'task_id', 'tag_id'];


    public function tasks()
    {
        return $this->belongsToMany('\App\Task', 'task_tags');
    }
}
