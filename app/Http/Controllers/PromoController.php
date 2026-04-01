<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

class PromoController extends Controller
{
    public function promoGet()
    {
        try {
            $promoId = Cache::get('promo_film_id');

            if ($promoId) {
                $film = \App\Models\Film::find($promoId);
                if ($film) {
                    return response()->json($film, 200);
                }
            }

            $film = \App\Models\Film::first();
            return response()->json($film, 200);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
    
    public function promoSet(string $id)
    {
        try {
            $film = \App\Models\Film::findOrFail($id);
            Cache::put('promo_film_id', $film->id, 86400);

            return response()->json($film, 200);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}
