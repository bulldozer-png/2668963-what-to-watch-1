<?php

namespace App\Http\Responses;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends BaseResponse
{
    protected string $message;

    public function __construct(
        Throwable $exception,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
    ) {
        parent::__construct([], $statusCode);

        $this->message = $exception->getMessage();
    }

    protected function makeResponseData(): ?array
    {
        return [
            'message' => $this->message,
        ];
    }
}