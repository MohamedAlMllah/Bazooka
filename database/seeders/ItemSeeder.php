<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'category_id' => 1,
            'name' => 'قهوة',
            'price' => 6,
            'description' => 'قهوة تركي',
        ]);
        Item::create([
            'category_id' => 1,
            'name' => 'شاي',
            'price' => 4,
        ]);
        Item::create([
            'category_id' => 1,
            'name' => 'كاكاو',
            'price' => 8.5,
        ]);
    }
}
