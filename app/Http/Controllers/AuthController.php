<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\ErrorResponse;

class AuthController extends Controller
{
    public function register(){
        try {
            $data = [
                'someData' => '',
            ];
            return new SuccessResponse($data);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
    public function login(){
        try {
            $data = [
                'someData' => '',
            ];
            return new SuccessResponse($data);

        } catch (\Throwable $e) {
            return new ErrorResponse($e);
        }
    }
    public function logout(){
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
