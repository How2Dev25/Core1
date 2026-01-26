<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SyncQueue;
use App\Models\Guest;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SyncTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sync_offline_data_to_domain()
    {
        // Create a test sync queue entry
        SyncQueue::create([
            'model_name' => 'Guest',
            'record_id' => 1,
            'action' => 'insert',
            'payload' => json_encode([
                'guest_id' => 1,
                'guest_name' => 'Test Guest',
                'email' => 'test@example.com',
                'phone' => '1234567890'
            ]),
            'synced' => false
        ]);

        // Mock the HTTP response from domain
        Http::fake([
            'https://hotel.soliera-hotel-restaurant.com/api/push-offline-data' => Http::response([
                'status' => 'success',
                'message' => 'Sync operation insert completed successfully'
            ], 200)
        ]);

        // Call the sync endpoint
        $response = $this->get('/sync-offline');

        // Assertions
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'completed',
            'success_count' => 1,
            'error_count' => 0
        ]);

        // Verify the sync queue entry is marked as synced
        $this->assertEquals(1, SyncQueue::where('synced', true)->count());
    }

    /** @test */
    public function receive_data_endpoint_works_correctly()
    {
        // Set the API token in environment for testing
        config(['services.api.token' => 'test-token']);

        $payload = [
            'guest_name' => 'Test Guest',
            'email' => 'test@example.com',
            'phone' => '1234567890'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer test-token'
        ])->postJson('/api/push-offline-data', [
            'model_name' => 'Guest',
            'action' => 'insert',
            'payload' => $payload
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Sync operation insert completed successfully'
        ]);

        // Verify the data was inserted into the database
        $this->assertDatabaseHas('guests', [
            'guest_name' => 'Test Guest',
            'email' => 'test@example.com',
            'phone' => '1234567890'
        ]);
    }
}
