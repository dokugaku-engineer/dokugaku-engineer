<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show(string $category)
    {
        return view('users.categories.show', [
            'category' => $category
        ]);
    }
}
