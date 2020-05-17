<?php

namespace Tests\Feature;

use App\Mail\PasswordChange;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
     use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        // now re-register all the roles and permissions
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    public function a_user_can_update_password()
    {
        // $this->withExceptionHandling();

        Mail::fake();

        $user = factory(User::class)->create(['password' => 'password']);

        Sanctum::actingAs($user, ['*']);

        $payload = [
            'current' => 'password',
            'new' => '$5VcDcMCS3Av'
        ];

        $response = $this->patchJson('/api/user/password', $payload)
            ->assertSuccessful();

        Mail::assertSent(PasswordChange::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    /** @test */
    public function a_user_cant_update_using_weak_password()
    {
        $user = factory(User::class)->create();

        Sanctum::actingAs($user);

        $payload = [
            'current' => 'password',
            'new' => 'simplePassword'
        ];

        $this->patchJson('/api/user/password', $payload)
            ->assertStatus(422);
    }
}
