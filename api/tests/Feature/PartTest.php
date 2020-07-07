<?php

namespace Tests\Feature;

use App\Models\Part;
use App\Models\TakingCourse;

class PartTest extends TestCase
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
        $part = Part::first();
        $response = $this->get("/api/parts?course={$takingCourse->course->name}&user_id={$takingCourse->user_id}");

        $response
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'name' => $part->name,
                ],
            ]);
    }

    /** @test */
    public function testIndexWithoutToken(): void
    {
        $response = $this->get('/api/parts');

        $response->assertUnauthorized();
    }
}
