<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class LearningHistoryRequest extends ApiRequest
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
            'user_id' => 'required|integer',
            'course_id' => 'required|integer',
            'lecture_id' => [
                'required',
                'integer',
                Rule::unique('learning_histories')->where(function ($query) {
                    return $query->where('user_id', $this->input('user_id'));
                }),
            ],
        ];
    }
}
