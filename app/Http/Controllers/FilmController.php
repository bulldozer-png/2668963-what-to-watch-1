<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmStoreRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Jobs\UpdateFilmJob;
use App\Models\Film;
use App\Services\FilmStoreService;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function __construct(private FilmStoreService $filmStoreService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $films = Film::all();

            return response()->json($films, 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmStoreRequest $request)
    {
        UpdateFilmJob::dispatch('tt0848228');
        try {
            $film = $this->filmStoreService->store($request->validated());
            return response()->json($film, 201);
            
            // return new SuccessResponse($film);

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
            $film = Film::find($id);

            return response()->json($film, 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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