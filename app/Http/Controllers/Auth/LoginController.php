<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Authenticate user using username or email field
     *
     * @param LoginRequest $request
     * @param User $user
     * @return void
     */
    public function login(LoginRequest $request, User $user)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $attempt = Auth::guard('web')
            ->attempt([
                $fieldType => strtolower($request->username),
                'password' => $request->password
            ]);

        if($attempt) {
            $user = Auth::guard('web')->user();
            $token = $user->createToken('Tokenizer');
            return response()->json([
                'success' => true,
                'message' => '',
                'token' => $token->plainTextToken
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid username / password'
            ], 422);
        }
    }
}
