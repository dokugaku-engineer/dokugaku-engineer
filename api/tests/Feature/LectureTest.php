<?php

namespace Tests\Feature;

use App\Models\Lecture;
use App\Models\TakingCourse;

class LectureTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function testIndex(): void
    {
        $this->withoutMiddleware();

        $takingCourse = TakingCourse::first();
        $lecture = Lecture::first();
        $response = $this->get("/api/lectures?course={$takingCourse->course->name}&user_id={$takingCourse->user_id}");

        $response
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'name' => $lecture->name,
                ],
            ]);
    }

    /** @test */
    public function testIndexWithoutToken(): void
    {
        $response = $this->get('/api/lectures');

        $response->assertUnauthorized();
    }

    /** @test */
    public function testShow(): void
    {
        $this->withoutMiddleware();

        $takingCourse = TakingCourse::first();
        $lecture = Lecture::where('course_id', $takingCourse->course_id)->first();
        $response = $this->get("/api/lectures/{$lecture->slug}?course={$takingCourse->course->name}&user_id={$takingCourse->user_id}");

        $response
            ->assertOk()
            ->assertJson([
                'name' => $lecture->name,
            ]);
    }

    /** @test */
    public function testShowWithoutToken(): void
    {
        $takingCourse = TakingCourse::first();
        $lecture = Lecture::where('course_id', $takingCourse->course_id)->first();
        $response = $this->get("/api/lectures/{$lecture->slug}?course={$takingCourse->course->name}&user_id={$takingCourse->user_id}");

        $response->assertUnauthorized();
    }
}
