<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

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
            'username' => 'unique:users',
            'email' => 'unique:users'
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
            'username.unique' => 'ユーザー名はすでに登録されています',
            'email.unique' => 'メールアドレスはすでに登録されています',
        ];
    }
}
