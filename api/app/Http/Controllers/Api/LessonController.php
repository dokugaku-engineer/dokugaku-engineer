<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Lesson\MinimumLesson as MinimumLessonResource;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\TakingCourse;
use Illuminate\Http\Request;

/**
 * @group 2. Courses
 */
class LessonController extends ApiController
{
    /**
     * レッスン一覧を取得
     *
     * @queryParam course Course name
     *
     * @responsefile responses/lesson.index.json
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $userId = $request['user_id'];
        $course = Course::where('name', $request->query('course'))->first();
        if (TakingCourse::doesntExist($userId, $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }
        $lessons = Lesson::where('course_id', $course->id)->get();

        return MinimumLessonResource::collection($lessons);
    }
}
