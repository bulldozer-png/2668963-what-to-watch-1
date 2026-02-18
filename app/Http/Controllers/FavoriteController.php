<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
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