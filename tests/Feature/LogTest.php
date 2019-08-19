<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{
    /**
     * A basic feature test logs results.
     *
     * @return void
     */
    public function testLogs()
    {
        $response = $this->get('/api/logs');

        $response->assertStatus(200);
    }
}
