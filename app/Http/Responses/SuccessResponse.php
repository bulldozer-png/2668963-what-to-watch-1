<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class SuccessResponse extends BaseResponse
{
    protected string $message;

    public function __construct(
        array $data = [],
        string $message = 'Success',
        int $statusCode = Response::HTTP_OK,
    ) {
        parent::__construct($data, $statusCode);
        $this->message = $message;
    }


    /**
     * Формирование содержания ответа.
     *
     * @return array
     */
    protected function makeResponseData(): ?array
    {
        return [
            'success' => true,
            'message' => $this->message,
            'data' => $this->prepareData(),
        ];
    }
}