<?php

namespace Tests\Feature;

use App\Models\LearningHistory;
use App\Models\Lecture;
use App\Models\TakingCourse;

class LearningHistoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function testStore(): void
    {
        $this->withoutMiddleware();

        $takingCourse = TakingCourse::first();
        $lecture = Lecture::where('course_id', $takingCourse->course_id)->first();
        $response = $this->postJson('/api/learning_histories', [
            'user_id' => $takingCourse->user_id,
            'course_id' => $takingCourse->course_id,
            'lecture_id' => $lecture->id,
        ]);

        $response
            ->assertCreated()
            ->assertJson([
                'user_id' => $takingCourse->user_id,
            ]);
    }

    /** @test */
    public function testStoreWithoutToken(): void
    {
        $takingCourse = TakingCourse::first();
        $lecture = Lecture::where('course_id', $takingCourse->course_id)->first();
        $response = $this->postJson('/api/learning_histories', [
            'user_id' => $takingCourse->user_id,
            'course_id' => $takingCourse->course_id,
            'lecture_id' => $lecture->id,
        ]);

        $response->assertUnauthorized();
    }

    /** @test */
    public function testStoreWithInvalidParams(): void
    {
        $this->withoutMiddleware();

        $takingCourse = TakingCourse::first();
        $lecture = Lecture::where('course_id', $takingCourse->course_id)->first();
        $response = $this->postJson('/api/learning_histories', [
            'user_id' => $takingCourse->user_id,
            'lecture_id' => $lecture->id,
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function testGetLectureIds(): void
    {
        $this->withoutMiddleware();

        $takingCourse = TakingCourse::first();
        $learningHistory = factory(LearningHistory::class)->create([
            'user_id' => $takingCourse->user_id,
            'course_id' => $takingCourse->course_id,
        ]);

        $response = $this->get("/api/learning_histories/{$takingCourse->course->name}/lecture_ids?user_id={$takingCourse->user_id}");

        $response
            ->assertOk()
            ->assertJson([$learningHistory->lecture_id]);
    }

    /** @test */
    public function testGetLectureIdsByOtherUser(): void
    {
        $this->withoutMiddleware();

        $takingCourse = TakingCourse::first();
        factory(LearningHistory::class)->create([
            'course_id' => $takingCourse->course_id,
        ]);

        $response = $this->get("/api/learning_histories/{$takingCourse->course->name}/lecture_ids?user_id={$takingCourse->user_id}");

        $response
            ->assertOk()
            ->assertJson([]);
    }

    /** @test */
    public function testGetLectureIdsWithoutToken(): void
    {
        $takingCourse = TakingCourse::first();
        factory(LearningHistory::class)->create([
            'user_id' => $takingCourse->user_id,
            'course_id' => $takingCourse->course_id,
        ]);

        $response = $this->get("/api/learning_histories/{$takingCourse->course->name}/lecture_ids?user_id={$takingCourse->user_id}");

        $response->assertUnauthorized();
    }
}
