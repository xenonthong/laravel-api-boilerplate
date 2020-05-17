<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Config;

class VerificationController extends Controller
{
    use Auth;

    public function __construct()
    {
        $this->middleware('throttle:6,1');
    }
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(User $user, String $hash)
    {
        if (!$user || !hash_equals($this->getHash($user), $hash)) {
            throw new AuthorizationException;
        }

        $expiry = Config::get('auth.verification.expiry');
        if ($user->created_at->addMinute($expiry)->lessThanOrEqualTo(now())) {
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }

            return response()->json([
                'success' => true,
                'message' => 'Email successfully verified. You may now proceed to login.'
            ]);
        }

        throw new AuthorizationException;
    }
}
