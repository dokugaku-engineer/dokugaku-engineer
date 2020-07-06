<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TakingCourseRequest;
use App\Http\Resources\TakingCourse\TakingCourse as TakingCourseResource;
use App\Models\TakingCourse;
use Illuminate\Database\QueryException;

/**
 * @group 3. Users
 */
class TakingCourseController extends ApiController
{
    /**
     * 受講情報を保存
     *
     * @bodyParam user_id int required User id. Example: 10
     * @bodyParam course_id int required Course id. Example: 1
     *
     * @responsefile responses/taking_course.store.json
     *
     * @param TakingCourseRequest $request
     * @return TakingCourseResource|\Illuminate\Http\JsonResponse
     */
    public function store(TakingCourseRequest $request)
    {
        try {
            $validated = $request->validated();
            $takingCourse = new TakingCourse($validated);
            $takingCourse->save();
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return new TakingCourseResource($takingCourse);
    }
}
