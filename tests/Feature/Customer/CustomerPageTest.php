<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CustomerPageTest extends TestCase
{
    /** @test */
    public function get_all_customer()
    {
        // $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/customer');

        $response->assertStatus(200);
    }
}
