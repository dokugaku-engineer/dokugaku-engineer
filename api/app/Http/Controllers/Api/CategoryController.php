<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Resources\Category\Category as CategoryResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * @group 1. Category
 */
class CategoryController extends ApiController
{
    /**
     * カテゴリー一覧を取得
     *
     * @queryParam except Category id to except
     * @responsefile responses/category.index.json
     *
     * @return CategoryResourceCollection
     *
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        // 除外指定されたIDを除外する
        $except_id = (int) $request->input('except');
        if ($except_id) {
            $categories = $categories->reject(function ($item) use (&$except_id) {
                return $item->id === $except_id;
            });
        }

        return CategoryResource::collection($categories);
    }

    /**
     * カテゴリーを保存
     *
     * @bodyParam name string required Category name. Example: ウェブ
     * @bodyParam slug string required Category slug. Example: web
     * @bodyParam parent int Parent ID. Example: 2
     * 
     * @response {
     *   "id": 13,
     *   "name": "ウェブ",
     *   "slug": "web",
     *   "parent": "2",
     *   "created_at": "2019-10-17T13:28:08Z",
     *   "updated_at": "2019-10-17T13:28:08Z"
     * }
     * 
     * @param CategoryRequest $request
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        try {
            $validated = $request->validated();
            $category = new Category($validated);
            $category->save();
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CategoryResource($category);
    }

    /**
     * カテゴリーを取得
     *
     * @bodyParam id int required Category id. Example: 13
     * 
     * @response {
     *   "id": 13,
     *   "name": "ウェブ",
     *   "slug": "web",
     *   "parent": "2",
     *   "created_at": "2019-10-17T13:28:08Z",
     *   "updated_at": "2019-10-20T13:28:08Z"
     * }
     * 
     * @param CategoryRequest $request
     * @param Category $category
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * カテゴリーを更新
     *
     * @bodyParam id int required Category id. Example: 13
     * @bodyParam name string required Category name. Example: ウェブ
     * @bodyParam slug string required Category slug. Example: web
     * @bodyParam parent int Parent ID. Example: 2
     * 
     * @response {
     *   "id": 13,
     *   "name": "ウェブ",
     *   "slug": "web",
     *   "parent": "2",
     *   "created_at": "2019-10-17T13:28:08Z",
     *   "updated_at": "2019-10-17T13:28:08Z"
     * }
     * 
     * @param CategoryRequest $request
     * @param Category $category
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $validated = $request->validated();
            $category->fill($validated);
            $category->save();
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CategoryResource($category);
    }
}
