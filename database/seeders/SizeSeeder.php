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



            DB::table('sizes')->insert([
                array(
                    'sizeName'=> "S",
                    'product-id'=>1,
                    'status'=>1,
                ),
                array(
                    'sizeName'=> "M",
                    'product-id'=>1,
                    'status'=>1,
                ),
                array(
                    'sizeName'=> "L",
                    'product-id'=>1,
                    'status'=>1,
                ),

            ]);

    }
}
