<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
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

        Passport::actingAs($user);

        $response = $this->getJson('/api/user')
            ->assertSuccessful();
        $response->assertJsonFragment($user->toArray());
    }
}
