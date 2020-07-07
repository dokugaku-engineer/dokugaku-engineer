<?php

namespace Tests\Feature;

use Tests\TestCase;

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
