<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewStoreService
{

    public function store(array $data)
    {
        return Review::create($data);
    }
}