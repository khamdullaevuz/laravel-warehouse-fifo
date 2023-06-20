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

        $product = Product::create([
            'name' => 'Samsung Galaxy S21 Ultra',
        ]);

        $product->batches()->createMany([
            [
                'price' => 20000000,
                'stock' => 100,
                'income_date' => '2023-06-18 09:00:00',
            ],
            [
                'price' => 19900000,
                'stock' => 200,
                'income_date' => '2023-06-19 09:00:00',
            ],
            [
                'price' => 19800000,
                'stock' => 300,
                'income_date' => '2023-06-20 09:00:00',
            ],

        ]);
    }
}
