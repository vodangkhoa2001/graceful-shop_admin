<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('colors')->insert([
            array(
                'colorName'=>"Đỏ",
                'colorCode'=>"ff0000",
                'productId'=>1,
                'status'=>1
            ),
            array(
                'colorName'=>"Trắng",
                'colorCode'=>"ffffff",
                'productId'=>1,
                'status'=>1
            ),
            array(
                'colorName'=>"Đen",
                'colorCode'=>"000000",
                'productId'=>1,
                'status'=>1
            ),
        ]);

    }
}
