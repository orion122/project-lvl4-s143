<?php

namespace Tests\Feature;

use \App\User;
use \App\Task;
use \App\Tag;
use \App\TaskStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterTest extends TestCase
{
    use RefreshDatabase;

    public function testStatusFilter()
    {
        $doneStatus = \App\TaskStatus::where('name', 'done')->first();

        $task1 = factory(Task::class)->create(['status' => $doneStatus->id]);
        $task2 = factory(Task::class)->create();

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get("/tasks");

        $response->assertSee($task1->name);
        $response->assertSee($task2->name);

        $response = $this->actingAs($user)
            ->get("/tasks?status=$doneStatus->id")
            ->assertStatus(200);

        $response->assertSee($task1->name);
        $response->assertDontSee($task2->name);
    }


    public function testCreatorFilter()
    {
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get("/tasks");

        $response->assertSee($task1->name);
        $response->assertSee($task2->name);

        $response = $this->actingAs($user)
            ->get("/tasks?creator=$task1->creator")
            ->assertStatus(200);

        $response->assertSee($task1->name);
        $response->assertDontSee($task2->name);
    }


    public function testAssignedToFilter()
    {
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get("/tasks");

        $response->assertSee($task1->name);
        $response->assertSee($task2->name);


        $response = $this->actingAs($user)
            ->get("/tasks?assignedTo=$task1->assignedTo")
            ->assertStatus(200);

        $response->assertSee($task1->name);
        $response->assertDontSee($task2->name);
    }


    public function testTagFilter()
    {
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();

        $tag1 = factory(Tag::class)->create();
        $tag2 = factory(Tag::class)->create();

        $user = factory(User::class)->make();


        $response = $this->actingAs($user)
            ->get("/tasks");

        $response->assertSee($task1->name);
        $response->assertSee($task2->name);


        $this->post("/tasks/$task1->id", [
            'name' => $task1->name,
            'description' => $task1->description,
            'status' => $task1->status,
            'creator' => $task1->creator,
            'assignedTo' => $task1->assignedTo,
            'tags' => $tag1->name,
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ]);


        $this->post("/tasks/$task2->id", [
            'name' => $task2->name,
            'description' => $task2->description,
            'status' => $task2->status,
            'creator' => $task2->creator,
            'assignedTo' => $task2->assignedTo,
            'tags' => $tag2->name,
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ]);


        $response = $this->actingAs($user)
            ->get("/tasks?tag_id=$tag1->id");

        $response->assertSee($task1->name);
        $response->assertDontSee($task2->name);
    }
}
