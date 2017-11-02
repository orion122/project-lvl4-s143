<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WithAuthTest extends TestCase
{
    use RefreshDatabase;

    public $user;


    public function setUp()
    {
        parent::setUp();
        $this->user = factory(\App\User::class)->create();
    }


    public function tearDown()
    {
        $this->user->delete();
        parent::tearDown();
    }


    public function testRoot()
    {
        $response = $this->actingAs($this->user)->get('/');

        $response->assertStatus(200);
    }


    public function testLogin()
    {
        $response = $this->actingAs($this->user)->get('/login');

        $response->assertRedirect('/');
    }


    public function testRegister()
    {
        $response = $this->actingAs($this->user)->get('/register');

        $response->assertRedirect('/');
    }


    public function testUsers()
    {
        $response = $this->actingAs($this->user)->get('/users');

        $response->assertStatus(200);
    }
}
