<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Resources\Category\Category as CategoryResource;
use Illuminate\Database\QueryException;

/**
 * @group 1. Category
 */
class CategoryController extends ApiController
{
    /**
     * Categoryを保存
     *
     * @bodyParam name string required Category name. Example: ウェブ
     * @bodyParam slug string required Category name. Example: web
     * @bodyParam parent string Parent ID. Example: 2
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
}
