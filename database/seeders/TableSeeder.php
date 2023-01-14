<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Table::create([
            'shop_id' => 1,
            'name' => 'table 1',
            'type' => 'playstation',
            'description' => 'playstation 5 مع كنبة مريحة',
        ]);
        Table::create([
            'shop_id' => 1,
            'name' => 'table 2',
            'type' => 'playstation',
            'description' => 'playstation 5',
        ]);
        Table::create([
            'shop_id' => 1,
            'name' => 'table 3',
            'type' => 'playstation',
            'description' => 'playstation 4',
        ]);
        Table::create([
            'shop_id' => 1,
            'name' => 'table 4',
            'type' => 'table',
        ]);
        Table::create([
            'shop_id' => 1,
            'name' => 'table 5',
            'type' => 'computer',
            'description' => 'computer',
        ]);
    }
}
