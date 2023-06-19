<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for($i = 1; $i < 4; $i++)
        {
            Product::create([
                'product_group_id' => 1,
                'name' => 'Samsung Galaxy S23 Ultra',
                'stock' => $i * 100,
                'price' => 10000000,
                'income_date' => now()->addDays($i),
            ]);
        }
    }
}
