<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        Category::create($validated);
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        // 全カテゴリーを取得する際に、親カテゴリーに自身が表示されないように除外する
        $categories = Category::all()->reject(function ($item) use (&$category) {
            return $item['id'] === $category->id;
        });
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->fill($validated);
        $category->save();
        return redirect()->route('admin.categories.index');
    }
}
