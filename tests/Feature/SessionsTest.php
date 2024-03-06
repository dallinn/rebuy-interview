<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Session;

class SessionsTest extends TestCase {
    use RefreshDatabase;

    /** @test */
    public function user_can_start_session() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/sessions/start', [
            'description' => 'Test Session',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('sessions', [
            'user_id'     => $user->id,
            'description' => 'Test Session',
            // Assert other fields as necessary
        ]);
    }

    /** @test */
    public function user_can_stop_session() {
        $user = User::factory()->create();

        $session = Session::create([
            'user_id'     => $user->id,
            'description' => 'Picking my nose.',
            'start_time'  => now(),
        ]);

        $response = $this->actingAs($user)->postJson('/api/sessions/stop', [
            'session_id' => $session->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('sessions', [
            'id'       => $session->id,
            'end_time' => now()->toDateTimeString(),
        ]);

    }

    /** @test */
    public function user_can_retrieve_session_history() {
        $user = User::factory()->create();

        Session::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/sessions/history');

        $response->assertOk()
                ->assertJsonStructure([
                    'sessions' => [
                        '*' => ['id', 'user_id', 'start_time', 'end_time', 'description']
                    ]
                ])
                ->assertJsonCount(5, 'sessions');
    }
}