<?php

namespace App\Services;

use App\Http\Requests\FilmStoreRequest;
use App\Models\Film;
use Illuminate\Support\Facades\Auth;

class FilmStoreService
{
    /**
     * Store a new film.
     *
     * @param array $data The film data.
     * @return Film
     */
    public function store(array $data)
    {
        return Film::create($data);
    }
}
