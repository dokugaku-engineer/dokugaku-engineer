<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\TakingCourse;
use App\Http\Resources\Lecture\LectureWithLearned as LectureWithLearnedResource;

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
     * @return JsonResponse
     *
     */
    public function index(Request $request)
    {
        $user_id = $request['user_id'];
        $course = Course::where('name', $request->query('course'))->first();
        if (TakingCourse::doesntExist($user_id, $course->id)) {
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
     * @param string $slug
     * @return LectureWithLearnedResource
     */
    public function show(Request $request, string $slug)
    {
        $user_id = $request['user_id'];
        $lecture = Lecture::whereSlug($slug)->withTrashed()->whereExistence(true)->first();
        $lecture->load_learning_histories($user_id);
        if (TakingCourse::doesntExist($user_id, $lecture->course_id)) {
            return $this->respondNotFound('Taking course not found');
        }

        return new LectureWithLearnedResource($lecture);
    }

    public function showTest(Request $request, string $slug)
    {
        $user_id = 1;
        $lecture = Lecture::whereSlug($slug)->withTrashed()->whereExistence(true)->first();
        $lecture->load_learning_histories($user_id);
        if (TakingCourse::doesntExist($user_id, $lecture->course_id)) {
            return $this->respondNotFound('Taking course not found');
        }

        return new LectureWithLearnedResource($lecture);
    }

    public function indexTest(Request $request)
    {
        $user_id = 1;
        $course = Course::where('name', 'serverside')->first();
        if (TakingCourse::doesntExist($user_id, $course->id)) {
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
}
