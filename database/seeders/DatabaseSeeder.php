<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Brand::factory(30)->create();
        // \App\Models\Store::factory(30)->create();
        // \App\Models\Shipping::factory(30)->create();
        // \App\Models\Customer::factory(80)->create();
        \App\Models\Product::factory(100)->create();
    }

}
