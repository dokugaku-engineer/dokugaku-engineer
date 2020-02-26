<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Http\Resources\Lecture\Lecture as LectureResource;

/**
 * @group 4. Lecture
 */
class LectureController extends Controller
{
    /**
     * レクチャーを取得
     *
     * @bodyParam slug string required Lecture slug. Example: bN5sY6
     *
     * @responsefile responses/lecture.show.json
     *
     * @param string $slug
     * @return LectureResource
     */
    public function show(string $slug)
    {
        $lecture = Lecture::where('slug', $slug)->first();
        return new LectureResource($lecture);
    }
}
