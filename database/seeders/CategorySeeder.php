<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            array(
                'categoryName'=>"Áo",
                'icon'=>"ao.sgv",
                'status'=>1
            ),
            array(
                'categoryName'=>"Quần",
                'icon'=>"quan.sgv",
                'status'=>1
            ),
            array(
                'categoryName'=>"Váy",
                'icon'=>"vay.sgv",
                'status'=>1
            ),
            array(
                'categoryName'=>"Giày",
                'icon'=>"giay.sgv",
                'status'=>1
            ),
        ]);
    }
}
