<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserUpdateTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        // now re-register all the roles and permissions
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    public function a_user_can_update_profile()
    {
        $user = factory(User::class)->create();

        Sanctum::actingAs($user);

        $payload = [
            'name' => 'Allan Joseph Cagadas',
            'username' => 'john_snow',
            'email' => 'ajmcagadas@gmail.com',
            'mobile' => '09177994990',
            'address' => 'Damilag, Bukidnon, Philippines'
        ];

        $this->patchJson('/api/user', $payload)
            ->assertSuccessful();
        $this->assertDatabaseHas('users', ['email' => $payload['email']]);
    }
}
