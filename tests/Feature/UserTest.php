<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Setting;
use App\Models\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_default_settings_after_creation()
    {
        // Create user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);

        // Confirm user has default settings
        $this->assertNotNull($user->settings);
        $this->assertEquals(25, $user->settings->duration);
    }

    /** @test */
    public function a_user_can_have_many_sessions()
    {
        $user = User::factory()->create();
        // Create two sessions for the user
        $sessions = Session::factory()->count(2)->create(['user_id' => $user->id]);

        // Assert the user has two sessions
        $this->assertEquals(2, $user->sessions()->count());
    }
}