<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WithAuthTest extends TestCase
{
    use DatabaseMigrations;

    public $user;


//    public function setUp()
//    {
//        parent::setUp();
//        $this->user = factory(\App\User::class)->create();
//    }
//
//
//    public function tearDown()
//    {
//        $this->user->delete();
//        parent::tearDown();
//    }


    public function testRoot()
    {
        $user = self::getUser();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }


    public function testLogin()
    {
        $user = self::getUser();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/');
    }


    public function testRegister()
    {
        $user = self::getUser();

        $response = $this->actingAs($user)->get('/register');

        $response->assertRedirect('/');
    }


    public function testUsers()
    {
        $user = self::getUser();

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(200);
    }


    private function getUser()
    {
        $user = factory(\App\User::class)->create();

        return $user;
    }
}
