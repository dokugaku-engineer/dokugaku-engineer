<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Course\Course as CourseResource;
use App\Http\Resources\Course\CourseWithLecture as CourseWithLectureResource;
use App\Models\Course;
use App\Models\TakingCourse;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index()
    {
        $courses = Course::all();

        return CourseResource::collection($courses);
    }

    /**
     * コースを取得
     *
     * @responsefile responses/course.show.json
     *
     * @param Request $request
     * @param string  $name
     * @return CourseResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, string $name)
    {
        $userId = $request['user_id'];
        $course = Course::where('name', $name)->first();
        if (TakingCourse::doesntExist($userId, $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }

        return new CourseResource($course);
    }

    /**
     * コースとレクチャー一覧を取得
     *
     * @responsefile responses/course.getAllLectures.json
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function getAllLectures()
    {
        $course = Course::with('parts.lessons.lectures')->get();

        return CourseWithLectureResource::collection($course);
    }
}
