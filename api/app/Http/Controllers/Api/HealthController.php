<?php

namespace App\Http\Controllers\Api;

class HealthController extends ApiController
{
    /**
     * レスポンス200を返す
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * TODO: DB疎通させたほうがよい
     */
    public function index()
    {
        return response()->json(
            [
                'health' => 'ok',
            ],
            200,
            []
        );
    }
}
