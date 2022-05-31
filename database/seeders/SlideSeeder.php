<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            array(
                'picture'=>'slide_01.png',
                'description'=>'mo ta su kien',
                'status'=>1,
            ),
            array(
                'picture'=>'slide_02.png',
                'description'=>'mo ta su kien 2',
                'status'=>1,
            ),
        ]);
    }
}
