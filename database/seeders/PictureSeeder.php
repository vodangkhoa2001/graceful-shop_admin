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
        for ($i=1; $i < 11; $i++) {
            for ($j=1; $j < 4; $j++) { 
                DB::table('pictures')->insert([
                    'productId'=>$i,
                    'pictureValue'=>'/img/products/'.$j.'.jpg',
                    'status'=>1
                ]);
            }
        }
    }
}
