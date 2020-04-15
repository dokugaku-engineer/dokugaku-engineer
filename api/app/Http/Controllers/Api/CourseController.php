<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\TakingCourse;
use App\Http\Resources\Course\Course as CourseResource;
use App\Http\Resources\Course\CourseWithLecture as CourseWithLectureResource;

/**
 * @group 2. Courses
 */
class CourseController extends ApiController
{
    /**
     * コース一覧を取得
     *
     * @responsefile responses/course.index.json
     *
     * @return CourseResourceCollection
     *
     */
    public function index(Request $request)
    {
        $courses = Course::all();
        return CourseResource::collection($courses);
    }

    /**
     * コースを取得
     *
     * @responsefile responses/course.show.json
     *
     * @return CourseResource
     *
     */
    public function show(Request $request, $name)
    {
        $user_id = $request['user_id'];
        $course = Course::where('name', $name)->first();
        if (TakingCourse::doesntExist($user_id, $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }
        return new CourseResource($course);
    }

    /**
     * コースとレクチャー一覧を取得
     *
     * @responsefile responses/course.getAllLectures.json
     *
     * @return CourseWithLectureResourceCollection
     *
     */
    public function getAllLectures(Request $request)
    {
        $course = Course::with('parts.lessons.lectures')->get();
        return CourseWithLectureResource::collection($course);
    }


    public function test(Request $request, $name)
    {
        $course = Course::where('name', $name)->first();
        if (TakingCourse::doesntExist(1, $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }
        return new CourseResource($course);
    }
}
