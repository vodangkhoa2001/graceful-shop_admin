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



            DB::tahle('sizes')->insert([
                array(
                    'sizeName'=> "S",
                    'productId'=>1,
                    'status'=>1,
                ),
                array(
                    'sizeName'=> "M",
                    'productId'=>1,
                    'status'=>1,
                ),
                array(
                    'sizeName'=> "L",
                    'productId'=>1,
                    'status'=>1,
                ),

            ]);

    }
}
