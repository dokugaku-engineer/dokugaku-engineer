<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LearningHistoryRequest;
use App\Http\Resources\LearningHistory\LearningHistory as LearningHistoryResource;
use App\Models\Course;
use App\Models\LearningHistory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * @group 3. Users
 */
class LearningHistoryController extends ApiController
{
    /**
     * 受講情報を保存
     *
     * @bodyParam user_id int required User id. Example: 10
     * @bodyParam lecture_id int required Lecture id. Example: 1
     *
     * @responsefile responses/learning_history.store.json
     *
     * @param LearningHistoryRequest $request
     * @return LearningHistoryResource|\Illuminate\Http\JsonResponse
     */
    public function store(LearningHistoryRequest $request)
    {
        try {
            $validated = $request->validated();
            $learningHistory = new LearningHistory($validated);
            $learningHistory->save();
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return new LearningHistoryResource($learningHistory);
    }

    /**
     * レクチャーIDを取得
     *
     * @bodyParam course_name string required Course name. Example: serverside
     *
     * @responsefile responses/learning_history.store.json
     *
     * @param Request $request
     * @param string  $course_name
     * @return LearningHistoryResource|\Illuminate\Http\JsonResponse
     */
    public function getLectureIds(Request $request, string $course_name)
    {
        $userId = $request['user_id'];
        $course = Course::where('name', $course_name)->first();
        $lectureIds = LearningHistory::where('user_id', $userId)->where('course_id', $course->id)->pluck('lecture_id')->toArray();

        return $this->respondWithOK($lectureIds);
    }
}
