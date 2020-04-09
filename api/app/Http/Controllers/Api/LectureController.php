<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\TakingCourse;
use App\Http\Resources\Lecture\LectureWithLearned as LectureWithLearnedResource;

/**
 * @group 4. Lecture
 */
class LectureController extends ApiController
{
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
        $lecture = Lecture::where('slug', $slug)->first();
        $lecture->load(['lesson.part'])->load_learning_histories($user_id);
        $course_id = $lecture->lesson->part->course_id;
        if (TakingCourse::doesntExist($user_id, $course_id)) {
            return $this->respondNotFound('Taking course not found');
        }

        return new LectureWithLearnedResource($lecture);
    }

    public function test(Request $request, string $slug)
    {
        $lecture = Lecture::where('slug', $slug)->first();
        $lecture->load(['lesson.part'])->load_learning_histories(1);
        return new LectureWithLearnedResource($lecture);
    }
}
