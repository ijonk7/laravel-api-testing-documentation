<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'hobby' => $this->faker->randomElement(['art', 'basketball', 'chess', 'fashion', 'video gaming', 'photography', 'music', 'dance', 'jogging', 'swimming']),
            'date_of_birth' => $this->faker->date(),
            'photo' => $this->faker->imageUrl(640, 480, $this->faker->name(), true),
            'age' => $this->faker->numberBetween(17, 70),
            'status' => $this->faker->randomElement(['single', 'married', 'divorce']),
            'vehicle' => $this->faker->randomElement(['motorcycle', 'car', 'bike']),
            'address' => $this->faker->address(),
        ];
    }
}
