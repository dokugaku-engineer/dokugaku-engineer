<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\TakingCourse;
use App\Http\Resources\Course\Course as CourseResource;
use App\Http\Resources\Course\CourseLecture as CourseLectureResource;

/**
 * @group 3. Course
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
        $categories = Course::all();
        return CourseResource::collection($categories);
    }

    /**
     * コースとレクチャー一覧を取得
     *
     * @responsefile responses/course.getAllLectures.json
     *
     * @return CourseLectureResource
     *
     */
    public function getAllLectures(Request $request)
    {
        $course = Course::with(['parts.lessons.lectures' => function ($query) {
            $query->where('lectures.public', 1);
        }])->get();
        return CourseLectureResource::collection($course);
    }

    /**
     * レクチャーを取得
     *
     * @bodyParam name string required Course name. Example: serverside
     *
     * @responsefile responses/course.getLectures.json
     *
     * @param string $slug
     * @return CourseLectureResource
     */
    public function getLectures(Request $request, $name)
    {
        $course = Course::where('name', $name)->first();
        if (TakingCourse::doesntExist($request['user_id'], $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }

        $course->withCourses();
        return new CourseLectureResource($course);
    }
}
