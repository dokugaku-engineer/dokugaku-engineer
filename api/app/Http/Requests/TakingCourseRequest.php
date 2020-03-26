<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class TakingCourseRequest extends ApiRequest
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
            'course_id' => [
                'required',
                'integer',
                Rule::unique('taking_courses')->where(function ($query) {
                    return $query->where('user_id', $this->input('user_id'));
                })
            ]
        ];
    }
}
