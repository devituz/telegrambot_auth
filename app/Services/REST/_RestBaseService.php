<?php

namespace App\Services\REST;

use App\Services\BaseService;

class _RestBaseService extends BaseService
{
    public function success($data): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data         # response data in array
        ]);
    }

    public function error(string $msg, int $code = 0): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => [
                'error' => $msg,      # error message
                'code' => $code       # error message code
            ]
        ]);
    }



}
