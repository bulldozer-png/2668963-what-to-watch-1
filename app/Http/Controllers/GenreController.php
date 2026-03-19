<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $genres = Genre::all();

            return response()->json($genres, 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'someData' => '',
            ];
            return new SuccessResponse($data);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = [
                'someData' => '',
            ];
            return new SuccessResponse($data);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        try {
            Gate::authorize('update-genre');
            $genre->update($request->all());
            
            return response()->json($genre);

            // return new SuccessResponse($data);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = [
                'someData' => '',
            ];
            return new SuccessResponse($data);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}