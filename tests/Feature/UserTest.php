<?php

namespace Tests\Feature;

use \App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    public function testEditTask()
    {
        $user = factory(User::class)->create();


        $this->actingAs($user)
            ->get("/users/$user->id/edit")
            ->assertStatus(200);


        $this->post("/users/$user->id", [
            'name' => 'new name',
            '_method' => 'PATCH',
            '_token' => csrf_token()
        ])->assertRedirect("/users/$user->id/edit");


        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'new name'
        ]);
    }



    public function testRemoveUser()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);


        $this->post("/users/{$user->id}", [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ]);


        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
}
