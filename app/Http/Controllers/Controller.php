<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function successResponse(
        array $data = [],
        int $statusCode = Response::HTTP_OK
    ): JsonResponse {
        return response()->json([
            'data' => $data,
        ], $statusCode);
    }

    protected function errorResponse(
        string $message = 'something went wrong',
        int $statusCode = Response::HTTP_BAD_REQUEST
    ): JsonResponse {
        $response = [
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }

}

