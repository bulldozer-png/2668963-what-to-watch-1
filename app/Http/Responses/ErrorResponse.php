<?php

namespace App\Http\Responses;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends BaseResponse
{
    protected string $message;

    /**
     * Create an error response.
     *
     * @param Throwable $exception The exception that occurred.
     * @param int $statusCode The HTTP status code.
     */
    public function __construct(
        Throwable $exception,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
    ) {
        parent::__construct([], $statusCode);

        $this->message = $exception->getMessage();
    }

    /**
     * Make the response data array.
     *
     * @return array|null
     */
    protected function makeResponseData(): ?array
    {
        return [
            'message' => $this->message,
        ];
    }
}
