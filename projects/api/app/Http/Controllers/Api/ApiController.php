<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    protected string|float $startTime;

    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    /**
     * @param mixed $data
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */
    protected function success(mixed $data, int $code = Response::HTTP_OK, string $message = 'OK'): JsonResponse
    {
        return new JsonResponse(
            data: [
                'status' => true,
                'data' => $data,
                'message' => $message,
                'errors' => null
            ],
            status: $code,
            options: JSON_PRETTY_PRINT,
        );
    }

    /**
     * @param array $errors
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */
    protected function fail(array $errors, int $code = Response::HTTP_CONFLICT, string $message = 'Fail'): JsonResponse
    {
        return new JsonResponse(
            data: [
                'status' => false,
                'data' => null,
                'message' => $message,
                'errors' => $errors
            ],
            status: $code,
            options: JSON_PRETTY_PRINT,
        );
    }

    /**
     * @return JsonResponse
     */
    public function status(): JsonResponse
    {
        return new JsonResponse(data: [
            'healthy' => true,
            'response_time' => number_format(
                    num: bcsub(
                        microtime(true),
                        $this->startTime, scale: 6),
                    decimals: 6) . 's'
        ]);
    }
}
