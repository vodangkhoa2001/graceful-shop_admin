<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slide_details')->insert([
            array(
                'slide-id'=>1,
                'product-id'=>1,

            ),
            array(
                'slide-id'=>1,
                'product-id'=>2,

            ),array(
                'slide-id'=>1,
                'product-id'=>3,

            ),array(
                'slide-id'=>2,
                'product-id'=>1,

            ),
        ]);
    }
}
