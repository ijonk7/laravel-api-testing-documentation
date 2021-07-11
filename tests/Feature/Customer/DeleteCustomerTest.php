<?php

namespace Tests\Feature\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class DeleteCustomerTest extends TestCase
{
    // use WithFaker, RefreshDatabase;
    use WithFaker;

    /** @test */
    public function delete_customer_success()
    {
        $this->withoutExceptionHandling();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        Storage::fake('customer');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $responseCreate = $this->post('/api/create-customer', [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'hobby' => $this->faker->randomElements(['art', 'basketball', 'chess', 'fashion', 'video gaming', 'photography', 'music', 'dance', 'jogging', 'swimming'], 3),
            'date_of_birth' => $this->faker->date(),
            'photo' => $file,
            'age' => $this->faker->numberBetween(17, 70),
            'status' => $this->faker->randomElements(['single', 'married', 'divorce'], 1),
            'vehicle' => $this->faker->randomElement(['motorcycle', 'car', 'bike']),
            'address' => $this->faker->address(),
        ]);

        $customer = Customer::first();

        $responseDelete = $this->delete('/api/delete-customer/' . $customer->id);
        $responseDelete->assertOk();
        $responseDelete->assertJson([
            'status'  => true,
            'message' => 'Data deleted successfully',
        ]);
    }
}
