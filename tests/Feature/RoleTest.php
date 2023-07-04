<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function testStore()
    {
        $data = ['name' => 'Test Role'];

        $response = $this->postJson('/api/role', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Role created successfully',
            ]);
    }

    public function testShow()
    {
        $response = $this->getJson('/api/role');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Role retrieved successfully',
            ]);
    }

    public function testEdit()
    {
        $response = $this->patchJson('/api/role/' . 3);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Role retrieved successfully'
            ]);
    }

    public function testUpdate()
    {
        $data = ['name' => 'Updated Role Name'];

        $response = $this->putJson('/api/role/' . 1, $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Role updated successfully',
            ]);
    }

    public function testDelete()
    {
        $response = $this->deleteJson('/api/role/' . 1);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Role deleted successfully',
            ]);
    }
}
