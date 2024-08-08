<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Task extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function login()
    {
        $response = $this->get('/api/login');

        $response->assertStatus(200);
    }
    public function registerUser()
    {
        $response = $this->get('/api/register');

        $response->assertStatus(200);
    }
}
