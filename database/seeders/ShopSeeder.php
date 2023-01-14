<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'owner_id' => 2,
            'name' => 'Droid',
            'address' => '1 شارع محطة السوق',
        ]);
    }
}
