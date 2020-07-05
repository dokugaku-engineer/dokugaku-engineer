<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CategoryRequest extends ApiRequest
{
    /**
     * 認可されているかを判定
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションルールを返す
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories')->ignore($this->category),
            ],
            'slug' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Z0-9\-_]+$/',
                Rule::unique('categories')->ignore($this->category),
            ],
            'parent' => 'numeric',
        ];
    }
}
