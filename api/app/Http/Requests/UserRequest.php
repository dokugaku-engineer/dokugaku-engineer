<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserRequest extends ApiRequest
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
            'username' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('users')->ignore($this->user)->where(function ($query) {
                    return $query->where('existence', 1);
                }),
            ],
            'email' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($this->user)->where(function ($query) {
                    return $query->where('existence', 1);
                }),
            ],
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'ユーザー名は必須です',
            'username.min' => 'ユーザー名は3文字以上で入力してください',
            'username.max' => 'ユーザー名は50文字以内で入力してください',
            'username.unique' => 'ユーザー名はすでに登録されています',
            'email.required' => 'メールアドレスは必須です',
            'email.max' => 'メールアドレスは255文字以内で入力してください',
            'email.unique' => 'メールアドレスはすでに登録されています',
        ];
    }
}
