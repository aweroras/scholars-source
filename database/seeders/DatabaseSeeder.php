<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Courier;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory(2)->create();
        Supplier::factory(2)->create();
        Courier::factory(2)->create();
    }
}
