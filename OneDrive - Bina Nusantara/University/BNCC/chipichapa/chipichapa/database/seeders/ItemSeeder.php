<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::insert([
            [
                'name' => 'Harry Potter',
                'price' => 150000,
                'image' => '', 
                'category_id' => 3,
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Lord of the Rings',
                'price' => 200000,
                'image' => '',
                'category_id' => 3,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
    
}
