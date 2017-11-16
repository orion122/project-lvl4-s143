<?php

namespace Tests\Feature;

use \App\User;
use \App\Task;
use \App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTask()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->make();
        $tag1 = factory(Tag::class)->make();
        $tag2 = factory(Tag::class)->make();


        $this->actingAs($user)
            ->get('/tasks/create')
            ->assertStatus(200);


        $this->post("/tasks", [
            'name' => $task->name,
            'description' => $task->description,
            'status' => $task->status,
            'creator' => $task->creator,
            'assignedTo' => $task->assignedTo,
            'tags' => "$tag1->name,$tag2->name"
        ])->assertRedirect('/tasks');


        $this->get("/tasks/$task->id")
            ->assertStatus(200);


        $this->assertDatabaseHas('tasks', [
            'name' => $task->name,
            'description' => $task->description,
            'status' => $task->status,
            'creator' => $task->creator,
            'assignedTo' => $task->assignedTo
        ]);


        $this->assertDatabaseHas('task_tags', [
            'tag_id' => Tag::where('name', $tag1->name)->first()->id,
            'task_id' => Task::where('name', $task->name)->first()->id,
        ]);


        $this->assertDatabaseHas('task_tags', [
            'tag_id' => Tag::where('name', $tag2->name)->first()->id,
            'task_id' => Task::where('name', $task->name)->first()->id,
        ]);
    }



    public function testEditTask()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $tagOld = factory(Tag::class)->create();
        $tagNew = factory(Tag::class)->make();


        $this->actingAs($user)
            ->get("/tasks/$task->id/edit")
            ->assertStatus(200);


        $newData = [
            'name' => "{$task->name}qwerty",
            'description' => "{$task->description}qwerty",
            'status' => \App\TaskStatus::where('name', 'done')->first()->id,
            'assignedTo' => $user->id,
            'tags' => $tagNew->name
        ];


        $this->post("/tasks/$task->id", [
            'name' => $newData['name'],
            'description' => $newData['description'],
            'status' => $newData['status'],
            'creator' => $task->creator,
            'assignedTo' => $newData['assignedTo'],
            'tags' => $newData['tags'],
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ])->assertRedirect("/tasks/$task->id/edit");


        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $newData['name'],
            'description' => $newData['description'],
            'status' => $newData['status'],
            'creator' => $task->creator,
            'assignedTo' => $newData['assignedTo']
        ]);


        $this->assertDatabaseHas('task_tags', [
            'tag_id' => Tag::where('name', $tagNew->name)->first()->id,
            'task_id' => $task->id
        ]);


        $this->assertDatabaseHas('tags', [
            'id' => Tag::where('name', $tagNew->name)->first()->id,
            'name' => $tagNew->name
        ]);
    }



    public function testRemoveTask()
    {
        $user = factory(User::class)->make();
        $task = factory(Task::class)->create();

        $this->actingAs($user);


        $this->post("/tasks/{$task->id}", [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ]);


        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
