<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Lecture\LectureWithLearned as LectureWithLearnedResource;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\TakingCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group 2. Courses
 */
class LectureController extends ApiController
{
    /**
     * コース一覧を取得
     *
     * @queryParam course Course name
     * @responsefile responses/lecture.index.json
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $userId = $request['user_id'];
        $course = Course::where('name', $request->query('course'))->first();
        if (TakingCourse::doesntExist($userId, $course->id)) {
            return $this->respondNotFound('Taking course not found');
        }
        // データ量が多いときにEloquentを使用するとResourcesの作成で遅くなったのでクエリビルダで処理
        $lectures = DB::table('lectures')
            ->select('id', 'lesson_id', 'order', 'name', 'slug')
            ->where('course_id', $course->id)
            ->where('existence', 1)
            ->orderBy('lesson_id')
            ->orderBy('order')
            ->get()
            ->toArray();

        return $this->respondWithOK($lectures);
    }

    /**
     * レクチャーを取得
     *
     * @bodyParam slug string required Lecture slug. Example: bN5sY6
     *
     * @responsefile responses/lecture.show.json
     *
     * @param  Request  $request
     * @param  string  $slug
     * @return LectureWithLearnedResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, string $slug)
    {
        $userId = $request['user_id'];
        $lecture = Lecture::whereSlug($slug)->withTrashed()->whereExistence(true)->first();
        $courseId = $lecture->course_id;
        $lecture->loadLearningHistories($userId, $courseId);
        if (TakingCourse::doesntExist($userId, $courseId)) {
            return $this->respondNotFound('Taking course not found');
        }

        return new LectureWithLearnedResource($lecture);
    }
}
