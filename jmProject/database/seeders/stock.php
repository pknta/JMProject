<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class stock extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */
    public function run()
    {
        DB::table('stock')->insert([
            'id' => 1,
            'nameProduct' => 'GForce NS70',
            'price' => 800000,
        ]);

        DB::table('stock')->insert([
            'id' => 2,
            'nameProduct' => 'GForce N50',
            'price' => 750000,
        ]);
        DB::table('stock')->insert([
            'id' => 3,
            'nameProduct' => 'GForce NS40',
            'price' => 600000,
        ]);
        DB::table('stock')->insert([
            'id' => 4,
            'nameProduct' => 'Incoe NS70',
            'price' => 850000,
        ]);
        DB::table('stock')->insert([
            'id' => 5,
            'nameProduct' => 'Incoe N100',
            'price' => 1000000,
        ]);
        DB::table('stock')->insert([
            'id' => 6,
            'nameProduct' => 'GS NS70',
            'price' => 875000,
        ]);
        DB::table('stock')->insert([
            'id' => 7,
            'nameProduct' => 'GForce NS40Z',
            'price' => 475000,
        ]);
        DB::table('stock')->insert([
            'id' => 8,
            'nameProduct' => 'GS NS40Z',
            'price' => 550000,
        ]);
    }
}
