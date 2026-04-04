<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Register a new user.
     *
     * @param array $data The registration data.
     * @return array
     */
    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return [
            'user' => $user,
        ];
    }

    /**
     * Authenticate a user and create a token.
     *
     * @param array $data The login credentials.
     * @return array
     */
    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            abort(401, __('auth.failed'));
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * Logout the authenticated user by deleting the current token.
     *
     * @return array
     */
    public function logout()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $token = $user->currentAccessToken();
        $token->delete();

        return ['message' => 'Logged out'];
    }
}
