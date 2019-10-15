<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function index()
    {
        return view('admin.tops.index');
    }
}
