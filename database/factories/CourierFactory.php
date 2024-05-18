<?php

namespace Database\Factories;

use App\Models\Courier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courier>
 */
class CourierFactory extends Factory
{
   
    protected $model = Courier::class;

    public function definition()
    {
        return [
            'courier_name' => $this->faker->company,
            'branch' => $this->faker->city,
            'image' => $this->faker->imageUrl(400, 300, 'product'), // Generate a random image URL
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
