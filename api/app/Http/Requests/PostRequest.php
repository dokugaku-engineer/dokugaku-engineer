<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PostRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'posts.slug' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Z0-9\-_]+$/',
                Rule::unique('posts', 'slug')->ignore($this->post),
            ],
            'posts.title' => 'required|max:255',
            'posts.content' => 'required',
            'posts.parent' => 'required|numeric',
            'categoryPosts.category_id' => 'required|numeric',
        ];
    }
}
