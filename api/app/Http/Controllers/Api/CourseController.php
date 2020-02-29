<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Resources\Course\Course as CourseResource;
use App\Http\Resources\Course\CourseLecture as CourseLectureResource;

/**
 * @group 3. Course
 */
class CourseController extends Controller
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
    public function getLectures(string $name)
    {
        $course = Course::where('name', $name)->first();
        $course->withCourses();
        return new CourseLectureResource($course);
    }
}
