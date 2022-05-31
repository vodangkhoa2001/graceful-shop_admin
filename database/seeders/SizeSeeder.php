<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 11; $i++) {
            DB::table('sizes')->insert([
                array(
                    'size_name'=> "S",
                    'product_id'=>$i,
                    'status'=>1,
                ),
                array(
                    'size_name'=> "M",
                    'product_id'=>$i,
                    'status'=>1,
                ),
                array(
                    'size_name'=> "L",
                    'product_id'=>$i,
                    'status'=>1,
                ),

            ]);
        }          
    }
}
