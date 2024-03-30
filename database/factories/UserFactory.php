<?php

namespace Database\Factories;
use App\Models\User;
use App\Mail\Verification;
use Illuminate\Support\Facades\Mail;


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
            'roles' => 'customer',
            'status' => 'Pending',
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
            $name = $this->faker->name(); // Generate a name using Faker
            $user->customer()->create([
                'name' => $name,
                'Address' => $this->faker->address(),
                'PhoneNumber' => $this->faker->regexify('[0-9]{11}'),
                'image' => 'default.jpg',
                'created_at' => now(),
            ]);
            
            // Send verification email with the generated name
            Mail::to($user->email)->send(new Verification($user->email, $name));
        });
    }
}