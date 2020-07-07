<?php

namespace Tests\Feature;

class HealthTest extends TestCase
{
    /** @test */
    public function testIndex(): void
    {
        $response = $this->get('/api/health');

        $response
            ->assertOk()
            ->assertJson([
                'health' => 'ok',
            ]);
    }
}
