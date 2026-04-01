<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;

class SimilarController extends Controller
{
    public function similar(string $id){
        try {
            $film = \App\Models\Film::findOrFail($id);
            $genreId = $film->genre_id;

            $similar = \App\Models\Film::where('genre_id', $genreId)
                ->where('id', '!=', $film->id)
                ->limit(10)
                ->get();

            return response()->json($similar, 200);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}