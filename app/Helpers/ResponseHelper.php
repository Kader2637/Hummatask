<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseHelper {
    public static array $response = [
        'code' => null,
        'message' => null,
        'data' => null,
    ];

    /**
     * success
     *
     * @param  mixed $data
     * @param  mixed $message
     * @param  mixed $code
     * @return JsonResponse
     */
    public static function success(mixed $data, string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        return response()->json(self::$response, self::$response['code']);
    }

    public static function error(mixed $data, string $message = null, int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        $response = response()->json(self::$response, self::$response['code']);
        throw new HttpResponseException($response);
    }
}
