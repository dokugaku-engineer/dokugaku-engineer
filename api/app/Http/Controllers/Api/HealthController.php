<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;

class HealthController extends ApiController
{
    // TODO: DB疎通させたほうがよい
    public function index()
    {
        return response()->json(
            [
                'health' => 'ok',
                'DB_CONNECTION' => env('DB_CONNECTION'),
                'AUTH0_AUDIENCE' => env('AUTH0_AUDIENCE'),
                'AUTH0_DOMAIN' => env('AUTH0_DOMAIN'),
                'AUTH0_MANAGEMENT_API_AUDIENCE' => env('AUTH0_MANAGEMENT_API_AUDIENCE'),
                'AUTH0_MANAGEMENT_API_CLIENT_ID' => env('AUTH0_MANAGEMENT_API_CLIENT_ID'),
                'AUTH0_MANAGEMENT_API_CLIENT_SECRET' => env('AUTH0_MANAGEMENT_API_CLIENT_SECRET'),
                'AUTH0_NAMESPACE' => env('AUTH0_NAMESPACE'),
            ],
            200,
            []
        );
    }
}
