<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Traits\Auth as TraitsAuth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use TraitsAuth;

    public function login(LoginRequest $request, User $user)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            $token = $user->createToken('Tokenizer')->accessToken;
            return response()->json([
                'success' => true,
                'message' => '',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid username / password'
            ], 422);
        }
    }
}
