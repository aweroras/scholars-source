<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'roles' => 'User', // Assuming default role is 'User'
            'status' => 'Pending', // Assuming default status is 'active'
            'email_verified_at' => now(),
            'created_at' => now(),
        ];
    }

    /**
     * Configure the model factory for a User with a Customer.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withCustomer()
    {
        return $this->afterCreating(function (User $user) {
            $user->customer()->create([
                'name' => $this->faker->name(),
                'Address' => $this->faker->address(),
                'PhoneNumber' => $this->faker->regexify('[0-9]{11}'),
                'image' => 'default.jpg', // Default image or generate random image path
                'created_at' => now(),
            ]);
        });
    }
}