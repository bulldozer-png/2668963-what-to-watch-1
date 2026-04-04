<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class SuccessResponse extends BaseResponse
{
    public function __construct(
        array $data = [],
        int $statusCode = Response::HTTP_OK,
    ) {
        parent::__construct($data, $statusCode);
    }


    /**
     * Формирование содержания ответа.
     *
     * @return array
     */
    protected function makeResponseData(): ?array
    {
        return [
            'data' => $this->prepareData(),
        ];
    }
}
