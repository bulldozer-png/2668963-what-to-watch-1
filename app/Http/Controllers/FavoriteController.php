<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            if ($user === null) {
                abort(401);
            }

            $favorites = $user->favorites()->with('film')->get();
            return response()->json($favorites, 200);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        try {
            $user = $request->user();
            if ($user === null) {
                abort(401);
            }

            $favorite = \App\Models\Favorite::firstOrCreate([
                'user_id' => $user->id,
                'film_id' => $id,
            ]);

            return response()->json($favorite, 201);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            $user = $request->user();
            if ($user === null) {
                abort(401);
            }

            $favorite = \App\Models\Favorite::where('user_id', $user->id)->where('film_id', $id)->firstOrFail();
            return response()->json($favorite, 200);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = $request->user();
            if ($user === null) {
                abort(401);
            }

            $favorite = \App\Models\Favorite::where('user_id', $user->id)->where('film_id', $id)->firstOrFail();
            $favorite->update($request->only(['film_id', 'user_id']));

            return response()->json($favorite, 200);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $user = $request->user();
            if ($user === null) {
                abort(401);
            }

            $favorite = \App\Models\Favorite::where('user_id', $user->id)->where('film_id', $id)->firstOrFail();
            $favorite->delete();

            return response()->json(null, 204);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}
