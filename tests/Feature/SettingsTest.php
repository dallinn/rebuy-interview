<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function user_can_update_settings()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->putJson('/api/settings', [
            'duration' => 30,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('settings', [
            'user_id' => $user->id,
            'pomodoro_duration' => 30,
        ]);
    }
}
