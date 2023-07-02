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
        $responseAdmin->assertStatus(302); // Check for initial redirect status


        $responseAdmin = $this->followRedirects($responseAdmin); // Follow the redirect and get the new response
        $responseAdmin->assertStatus(200); // Check for the final response status
    }

    public function testUserCannotAccessRoutes(): void
    {
        $baseUrl = 'http://127.0.0.1:8000';

        // Assuming the routes page URL
        $routesUrl = $baseUrl . '/routes';

        // Assuming the user with the "user" role
        $user = User::factory()->create(['role' => 'user', 'name' => 'User', 'password' => '1234567890q2']);

        $username = 'User';
        $password = '1234567890q2';

        // Attempt to access the routes page with user credentials
        $ch = curl_init($routesUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check that the response status code is 403 (Forbidden)
        $this->assertEquals(403, $httpCode);
    }

}
