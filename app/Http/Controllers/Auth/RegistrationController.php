<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\User;
use App\Enums\Roles;

class RegistrationController extends Controller
{
    /**
     * Register a user
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());
        $user->assignRole(Roles::GUEST);
        $user->sendEmailVerificationNotification();

        return $user;
    }
}
