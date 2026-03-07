<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return [
            'user' => $user,
        ];
    }

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            abort(401, trans('auth.failed'));
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        /** @var \Laravel\Sanctum\PersonalAccessToken $token */
        $token = $user->currentAccessToken();
        $token->delete();

        return ['message' => 'Logged out'];

    }
}