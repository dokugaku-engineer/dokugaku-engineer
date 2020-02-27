<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Resources\Course\CourseLecture as CourseLectureResource;

/**
 * @group 3. Course
 */
class CourseController extends Controller
{
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
