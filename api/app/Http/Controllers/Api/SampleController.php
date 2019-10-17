<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class SampleController extends Controller
{
    public function index()
    {
        return response()->json(['title' => 'thanks god'], 200, []);
    }
}
