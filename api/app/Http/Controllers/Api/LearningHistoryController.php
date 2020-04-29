<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
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
            $learning_history = new LearningHistory($validated);
            $learning_history->save();
        } catch (QueryException $e) {
            return $this->respondInvalidQuery($e);
        }

        return new LearningHistoryResource($learning_history);
    }

    public function getLectureIds(Request $request, $course_name)
    {
        $user_id = $request['user_id'];
        $course = Course::where('name', $course_name)->first();
        $lecture_ids = LearningHistory::where('user_id', $user_id)->where('course_id', $course->id)->pluck('lecture_id')->toArray();
        return $this->respondWithOK($lecture_ids);
    }
}
