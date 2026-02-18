<?php

namespace App\Http\Controllers;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;

class SimilarController extends Controller
{
    public function similar(){
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