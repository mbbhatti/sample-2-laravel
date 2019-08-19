<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    /**
     * Test wrong api.
     *
     * @return void
     */
    public function testWrongApi()
    {
        $response = $this->post('/email',[]);        

        $response->assertStatus(405);
    }

    /**
     * Test required email.
     *
     * @return void
     */
    public function testRequiredEmail()
    {
        $response = $this->post('/api/email',[]);

        $response->assertStatus(400);
    }

    /**
     * Test required messge.
     *
     * @return void
     */
    public function testRequiredMessage()
    {
        $response = $this->post('/api/email',
                        ["email" => "mbbhatti@gmail.com"]
                    );        

        $response->assertStatus(400);
    }

    /**
     * Test single email.
     *
     * @return void
     */
    public function testSingleEmail()
    {
        $response = $this->post('/api/email',
                        [
                            "email" => "mbbhatti@gmail.com", 
                            "message" => "<p>It is a single test email message.</p>"
                        ]
                    );

        $response->assertStatus(200);
    }

    /**
     * Test multiple email.
     *
     * @return void
     */
    public function testMultipleEmail()
    {
        $response = $this->post('/api/email',
                        [
                            "email" => "mbbhatti@gmail.com, hr_tsc@yahoo.com", 
                            "message" => "<p>It is multiple test email message.</p>"
                        ]
                    );       

        $response->assertStatus(200);
    }
}
