<?php

namespace App\Services;

use App\Http\Requests\FilmStoreRequest;
use App\Models\Film;
use Illuminate\Support\Facades\Auth;

class FilmStoreService
{

    public function store(array $data)
    {
        return Film::create($data);
    }
}