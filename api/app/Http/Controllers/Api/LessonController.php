<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\TakingCourse;
use App\Http\Resources\Lesson\MinimumLesson as MinimumLessonResource;

/**
 * @group 2. Courses
 */
class LessonController extends ApiController
{
    /**
     * レッスン一覧を取得
     *
     * @queryParam course Course name
     * @responsefile responses/lesson.index.json
     *
     * @return MinimumLessonResource
     *
     */
    public function index(Request $request)
    {
        $user_id = $request['user_id'];
        $course = Course::where('name', $request->query('course'))->first();
        if (TakingCourse::doesntExist($user_id, $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }
        $lessons = Lesson::where('course_id', $course->id)->get();
        return MinimumLessonResource::collection($lessons);
    }

    public function test(Request $request)
    {
        $user_id = 1;
        $course = Course::where('name', 'serverside')->first();
        if (TakingCourse::doesntExist($user_id, $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }
        $lessons = Lesson::where('course_id', $course->id)->get();
        return MinimumLessonResource::collection($lessons);
    }
}
