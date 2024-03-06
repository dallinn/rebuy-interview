<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SettingsTest extends TestCase {
    use RefreshDatabase;

    /** @test */
    public function user_can_update_settings() {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->putJson('/api/settings', [
            'duration' => 30,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('settings', [
            'user_id'           => $user->id,
            'duration' => 30,
        ]);
    }
}
