<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class HealthController extends Controller
{
    // TODO: DB疎通させたほうがよい
    public function index()
    {
        return response()->json(
            [
                'health' => 'ok',
                'name' => env('APP_NAME'),
                'env' => env('APP_ENV'),
                'key' => env('APP_KEY'),
                'debug' => env('APP_DEBUG'),
                'url' => env('APP_URL'),
                'scheme' => env('CLIENT_SCHEME'),
                'clienturl' => env('CLIENT_URL'),
                'log' => env('LOG_CHANNEL'),
                'connection' => env('DB_CONNECTION'),
                'r' => env('DB_READ_HOST'),
                'w' => env('DB_WRITE_HOST'),
                'po' => env('DB_PORT'),
                'd' => env('DB_DATABASE'),
                'u' => env('DB_USERNAME'),
                'ps' => env('DB_PASSWORD'),
            ],
            200, []);
    }
}
