<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * 使用していないクラス
 */
class TopController extends Controller
{
    /**
     * View を返す
     *
     * @return string
     */
    public function index(): string
    {
        return view('admin.tops.index');
    }
}
