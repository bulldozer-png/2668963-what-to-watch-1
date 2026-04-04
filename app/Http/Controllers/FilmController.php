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
    public function __construct(private FilmStoreService $filmStoreService)
    {
    }

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
        try {
            $data = $request->validated();

            if (! empty($data['imdb_id'])) {
                UpdateFilmJob::dispatch($data['imdb_id']);
            }

            $film = $this->filmStoreService->store($data);
            return response()->json($film, 201);
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
            $film = Film::findOrFail($id);
            $film->update($request->only([
                'title',
                'description',
                'release_year',
                'genre_id',
                'big_image',
                'small_image',
                'bg_image',
                'bg_color',
                'director',
                'cast_list',
                'duration_minutes',
                'video_link',
                'trailer_link',
                'rating',
            ]));

            return response()->json($film, 200);
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
            $film = Film::findOrFail($id);
            $film->delete();

            return response()->json(null, 204);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}
