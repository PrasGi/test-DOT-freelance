<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testCreate()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'role_id' => 3,
            'password' => 'testpassword',
        ];

        $response = $this->postJson('/api/user', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'User created successfully',
            ]);
    }

    public function testShow()
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User retrieved successfully',
            ]);
    }

    public function testEdit()
    {
        $response = $this->patchJson('/api/user/' . 3);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User retrieved successfully',
            ]);
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'Updated User Name',
            'role_id' => 2
        ];

        $response = $this->putJson('/api/user/' . 3, $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User updated successfully',
            ]);
    }

    public function testDelete()
    {
        $response = $this->deleteJson('/api/user/' . 4);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User deleted successfully',
            ]);
    }
}
