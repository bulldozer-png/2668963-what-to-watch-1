<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewStoreService
{
    /**
     * Store a new review.
     *
     * @param array $data The review data.
     * @return Review
     */
    public function store(array $data)
    {
        return Review::create($data);
    }
}
