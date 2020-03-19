<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CourseUserRequest;
use App\Http\Resources\CourseUser\CourseUser as CourseUserResource;
use App\Models\CourseUser;
use Illuminate\Database\QueryException;

/**
 * @group 6. Course user
 */
class CourseUserController extends ApiController
{
    /**
     * 受講情報を保存
     *
     * @bodyParam user_id int required User id. Example: 10
     * @bodyParam course_id int required Course id. Example: 1
     *
     * @responsefile responses/course_user.store.json
     *
     * @param CourseUserRequest $request
     * @return CourseUserResource|\Illuminate\Http\JsonResponse
     */
    public function store(CourseUserRequest $request)
    {
        try {
            $validated = $request->validated();
            $course_user = new CourseUser($validated);
            $course_user->save();
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return new CourseUserResource($course_user);
    }
}
