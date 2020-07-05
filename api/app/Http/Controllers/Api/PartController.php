<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Part\MinimumPart as MinimumPartResource;
use App\Models\Course;
use App\Models\Part;
use App\Models\TakingCourse;
use Illuminate\Http\Request;

/**
 * @group 2. Courses
 */
class PartController extends ApiController
{
    /**
     * パート一覧を取得
     *
     * @queryParam course Course name
     * @responsefile responses/part.index.json
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user_id = $request['user_id'];
        $course = Course::where('name', $request->query('course'))->first();
        if (TakingCourse::doesntExist($user_id, $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }
        $parts = Part::where('course_id', $course->id)->get();

        return MinimumPartResource::collection($parts);
    }
}
