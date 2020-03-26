<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\LearningHistoryRequest;
use App\Http\Resources\LearningHistory\LearningHistory as LearningHistoryResource;
use App\Models\LearningHistory;
use Illuminate\Database\QueryException;

/**
 * @group 7. Learning history
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
}
