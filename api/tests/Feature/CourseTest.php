<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\TakingCourse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function testIndex(): void
    {
        $this->withoutMiddleware();

        $response = $this->get('/api/courses');
        $course = Course::first();

        $response
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'name' => $course->name,
                ],
            ]);
    }

    /** @test */
    public function testIndexWithoutToken(): void
    {
        $response = $this->get('/api/courses');

        $response->assertUnauthorized();
    }

    /** @test */
    public function testShow(): void
    {
        $this->withoutMiddleware();

        $takingCourse = TakingCourse::first();
        $response = $this->get("/api/courses/{$takingCourse->name}?user_id={$takingCourse->user_id}");

        $response
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'name' => $takingCourse->course->name,
                ],
            ]);
    }

    /** @test */
    public function testShowWithoutToken(): void
    {
        $takingCourse = TakingCourse::first();
        $response = $this->get("/api/courses/{$takingCourse->name}?user_id={$takingCourse->user_id}");

        $response->assertUnauthorized();
    }

    /** @test */
    public function testGetAllLectures(): void
    {
        $this->withoutMiddleware();

        $response = $this->get('/api/courses/lectures');
        $course = Course::first();

        $response
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'name' => $course->name,
                ],
            ]);
    }

    /** @test */
    public function testGetAllLecturesWithoutToken(): void
    {
        $response = $this->get('/api/courses/lectures');

        $response->assertUnauthorized();
    }
}
