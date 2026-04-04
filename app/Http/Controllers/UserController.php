<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the authenticated user's profile.
     */
    public function show()
    {
        try {
            $user = Auth::user();

            if (! $user) {
                abort(401);
            }

            return response()->json($user, 200);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            if (! $user) {
                abort(401);
            }

            $validated = $request->validate([
                'name' => ['sometimes', 'string', 'max:255'],
                'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            ]);

            if (array_key_exists('password', $validated)) {
                $validated['password'] = Hash::make($validated['password']);
            }

            $user->update($validated);

            return response()->json($user, 200);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}
