<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Services\ReviewStoreService;
use App\Http\Requests\ReviewStoreRequest;

class ReviewController extends Controller
{
    public function __construct(private ReviewStoreService $reviewStoreService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reviews = Review::all();
            return response()->json($reviews, 200);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewStoreRequest $request)
    {
        try {
            $review = $this->reviewStoreService->store($request->validated());
            return response()->json($review, 201);
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
            $reviews = Review::where('film_id', $id)->get();

            return response()->json($reviews, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewStoreRequest $request, Review $review)
    {
        try {
            Gate::authorize('update-review', $review);
            $review->update($request->validated());

            return response()->json($review);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        try {
            Gate::authorize('delete-review', $review);
            $review->delete();

            return response()->json(['deleted' => true]);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}
