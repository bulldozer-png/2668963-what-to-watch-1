<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseResponse implements Responsable
{
    protected array $data;
    protected int $statusCode;

    public function __construct(
        array $data = [],
        int $statusCode = Response::HTTP_OK,
    ) {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    /**
     * Создание HTTP-ответа.
     *
     * @param  Request $request
     * @return Response
     */
    public function toResponse($request)
    {
        return response()->json($this->makeResponseData(), $this->statusCode);
    }

    /**
     * Преобразование возвращаемых данных к массиву.
     *
     * @return array
     */
    protected function prepareData(): array
    {
        if ($this->data instanceof Arrayable) {
            return $this->data->toArray();
        }

        return $this->data;
    }

    /**
     * Формирование содержимого ответа.
     *
     * @return array|null
     */
    abstract protected function makeResponseData(): ?array;
}
