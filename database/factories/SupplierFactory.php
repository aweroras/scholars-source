<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supplier_name' => $this->faker->company,
            'image' => $this->faker->imageUrl(400, 300, 'product'), // Generate a random image URL
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
