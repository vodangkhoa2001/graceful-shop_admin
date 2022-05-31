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
        for ($i=1; $i < 11; $i++) {
            DB::table('colors')->insert([
            array(
                'color_name'=>'Đỏ',
                'picture'=> '1.jpg',
                'product_id'=>$i,
                'status'=>1
            ),
            array(
                'color_name'=>'Trắng',
                'picture'=>'2.jpg',
                'product_id'=>$i,
                'status'=>1
            ),
            // array(
            //     'color_name'=>'Đen',
            //     'picture'=>'3.jpg',
            //     'product_id'=>1,
            //     'status'=>1
            // ),
            ]);
        }       
    }
}
