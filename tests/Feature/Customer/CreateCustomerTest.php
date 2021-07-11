<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
{
    // use WithFaker, RefreshDatabase;
    use WithFaker;

    /** @test */
    public function create_customer_success()
    {
        $this->withoutExceptionHandling();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        Storage::fake('customer');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post('/api/create-customer', [
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


        $response->assertSessionHasNoErrors();
        $response->assertCreated();
        $response->assertJson([
            'status'  => true,
            'message' => 'Data saved successfully',
        ]);
    }

    /**
     * @test
     * @dataProvider fieldData
     * */
    public function create_customer_error_when_a_field_is_not_provided(array $values)
    {
        // $this->withoutExceptionHandling();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        Storage::fake('customer');
        $file = UploadedFile::fake()->image('avatar.jpg');

        if (Arr::exists($values, 'photo')) {
            $values['photo'] = $file;
        }

        $response = $this->post('/api/create-customer', $values);
        $response->assertJson([
            'status' => false,
        ]);
    }

    public function fieldData()
    {
        return [
            [[
                // 'name' => 'Dariana Morar',
                'email' => 'brenden10@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                'photo' => null,
                'age' => 55,
                'status' => 'single',
                'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                // 'email' => 'brenden03@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                'photo' => null,
                'age' => 55,
                'status' => 'single',
                'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                'email' => 'brenden03@example.net',
                // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                'photo' => null,
                'age' => 55,
                'status' => 'single',
                'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                'email' => 'brenden03@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                // 'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                'photo' => null,
                'age' => 55,
                'status' => 'single',
                'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                'email' => 'brenden03@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                // 'date_of_birth' => '1988-08-04',
                'photo' => null,
                'age' => 55,
                'status' => 'single',
                'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                'email' => 'brenden03@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                // 'photo' => null,
                'age' => 55,
                'status' => 'single',
                'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                'email' => 'brenden03@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                'photo' => null,
                // 'age' => 55,
                'status' => 'single',
                'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                'email' => 'brenden03@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                'photo' => null,
                'age' => 55,
                // 'status' => 'single',
                'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                'email' => 'brenden03@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                'photo' => null,
                'age' => 55,
                'status' => 'single',
                // 'vehicle' => 'car',
                'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
            [[
                'name' => 'Dariana Morar',
                'email' => 'brenden03@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'hobby' => ['fashion','swimming','dance'],
                'date_of_birth' => '1988-08-04',
                'photo' => null,
                'age' => 55,
                'status' => 'single',
                'vehicle' => 'car',
                // 'address' => '2913 Kyla Square Suite 538 Port Eveline, ND 16002-3333',
            ]],
        ];
    }
}
