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
                'c' => env('DB_CONNECTION'),
                'r' => env('DB_READ_HOST'),
                'r' => env('DB_WRITE_HOST'),
                'p' => env('DB_PORT'),
                'd' => env('DB_DATABASE'),
                'u' => env('DB_USERNAME'),
                'p' => env('DB_PASSWORD'),
                's' => env('DB_SOCKET'),
            ],
            200, []);
    }
}
