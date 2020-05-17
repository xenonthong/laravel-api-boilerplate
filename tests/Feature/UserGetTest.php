<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserGetTest extends TestCase
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

        $response = $this->getJson('/api/user')
            ->assertSuccessful();
        $response->assertJsonFragment($user->toArray());
    }
}
