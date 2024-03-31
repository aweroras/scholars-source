<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->withCustomer()->count(3)->create();
        Product::factory(5)->create();
        Supplier::factory(5)->create();
    }
}
