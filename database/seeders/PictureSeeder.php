<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 7; $i++) {
            for ($j=1; $j < 4; $j++) {
                DB::table('pictures')->insert([
                    'product-id'=>$i,
                    'pictureValue'=>'hinh-sp-'.$j.'.jpg',
                    'status'=>1
                ]);
            }
        }
    }
}
