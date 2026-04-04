<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\ErrorResponse;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    /**
     * Register a new user.
     *
     * @param RegisterRequest $request The validated registration request data.
     * @return SuccessResponse|ErrorResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $data = $this->authService->register($request->validated());
            return new SuccessResponse($data);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
    /**
     * Authenticate a user and return a token.
     *
     * @param LoginRequest $request The validated login request data.
     * @return SuccessResponse|ErrorResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $data = $this->authService->login($request->validated());
            return new SuccessResponse($data);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
    /**
     * Logout the authenticated user.
     *
     * @return SuccessResponse|ErrorResponse
     */
    public function logout()
    {
        try {
            $data = $this->authService->logout();
            return new SuccessResponse($data, 204);
        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
}
