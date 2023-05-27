<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\TestHelper;

class SmsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_prevents_unauthenticated_access_to_sms_sending_form()
    {
        $response = $this->get(route('sms.create'));
        $response->assertStatus(302);
    }

    /** @test */
    public function it_prevents_unauthorized_access_to_sms_sending_form()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs(TestHelper::user());
        $response = $this->get(route('sms.create'));
        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_authorized_access_to_sms_sending_form()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(TestHelper::user(['send_sms']));
        $response = $this->get(route('sms.create'));
        $response->assertStatus(200);
    }
}
