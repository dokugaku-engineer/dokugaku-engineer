<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

/**
 * 使用していないクラス
 */
class CategoryController extends Controller
{
    /**
     * View を返す
     *
     * @return string
     */
    public function index(): string
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * View を返す
     *
     * @return string
     */
    public function create(): string
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * カテゴリーを保存してリダイレクトする
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        Category::create($validated);
        return redirect()->route('admin.categories.index');
    }

    /**
     * View を返す
     *
     * @return string
     */
    public function edit(Category $category): string
    {
        // 全カテゴリーを取得する際に、親カテゴリーに自身が表示されないように除外する
        $categories = Category::all()->reject(function ($item) use (&$category) {
            return $item['id'] === $category->id;
        });
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * カテゴリーを保存してリダイレクトする
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->fill($validated);
        $category->save();
        return redirect()->route('admin.categories.index');
    }
}
