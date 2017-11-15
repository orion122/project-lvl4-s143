<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WithoutAuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoot()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }


    public function testRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }


    public function testUsers()
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }


    public function testTasks()
    {
        $response = $this->get('/tasks');

        $response->assertRedirect('/login');
    }
}
