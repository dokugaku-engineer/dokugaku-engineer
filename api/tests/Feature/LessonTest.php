<?php

namespace Tests\Feature;

use App\Models\Lesson;
use App\Models\TakingCourse;

class LessonTest extends TestCase
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
        $lesson = Lesson::first();
        $response = $this->get("/api/lessons?course={$takingCourse->course->name}&user_id={$takingCourse->user_id}");

        $response
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'name' => $lesson->name,
                ],
            ]);
    }

    /** @test */
    public function testIndexWithoutToken(): void
    {
        $response = $this->get('/api/lessons');

        $response->assertUnauthorized();
    }
}
