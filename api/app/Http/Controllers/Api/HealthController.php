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
            ],
            200,
            []
        );
    }
}
