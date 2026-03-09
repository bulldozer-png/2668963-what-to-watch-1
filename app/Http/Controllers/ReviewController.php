<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
    public function update(Request $request, Review $review)
    {
        try {
            Gate::authorize('update-review', $review);
            $review->update($request->all());
            
            return response()->json($review);


            // return new SuccessResponse($data);

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
            
            // return new SuccessResponse($data);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}
