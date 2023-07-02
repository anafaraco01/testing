<?php

namespace Tests\Feature;

use App\Http\Controllers\APIInsertDataFix;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomersTableTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testTableIsDisplayed(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->withSession(['role' => 'admin'])
            ->followingRedirects()
            ->get('/level3');

        $responseContent = $response->getContent();
        $this->assertStringContainsString('<table', $responseContent);

        $trCount = substr_count($responseContent, '<tr');

        // Assert that there are more than 10 <tr> elements
        $this->assertGreaterThanOrEqual(5, $trCount);
    }

    public function testTableDoesNotDisplay(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->withSession(['role' => 'admin'])
            ->followingRedirects()
            ->get('/level3');

        $responseContent = $response->getContent();
        $this->assertStringContainsString('<table', $responseContent);

        // Count the number of <tr> elements in the table
        $trCount = substr_count($responseContent, '<tr');

        // Assert that the table is not displayed correctly
        $this->assertLessThanOrEqual(6, $trCount, 'The table is not displayed.');
    }
}
