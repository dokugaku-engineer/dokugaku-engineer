<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;

class HealthController extends ApiController
{
    /**
     * レスポンス200を返す
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * TODO: DB疎通させたほうがよい
     *
     */
    public function index()
    {
        return response()->json(
            [
                'health' => 'ok'
            ],
            200,
            []
        );
    }
}
