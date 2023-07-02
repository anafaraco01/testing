<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testAdminCanAccessRoutes(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $responseAdmin = $this->actingAs($admin)->get('/routes');
        $responseAdmin->assertStatus(200); // Check for initial redirect status
    }

    public function testUserCannotAccessRoutes(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $responseAdmin = $this->actingAs($user)->get('/routes');
        $responseAdmin->assertStatus(403); // Check for initial redirect status
    }
}
