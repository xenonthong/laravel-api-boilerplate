<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Config;

trait Auth {
    /**
     * Remove generated token on DB
     *
     * @return void
     */
    public function logout()
    {
        if (FacadesAuth::check()) {
            FacadesAuth::user()->tokens()->delete();
        }
    }

    /**
     * Generate a hashable string for user account verification
     *
     * @param User $user
     * @return string
     */
    public function getHashable(User $user): string
    {
        return $user->getEmailForVerification() . $user->created_at;
    }

    public function getHash(User $user): string
    {
        return hash_hmac(Config::get('auth.verification.algo'), $this->getHashable($user), Config::get('app.key'));
    }
}
