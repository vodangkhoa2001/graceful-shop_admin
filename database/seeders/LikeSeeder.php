<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=1; $i < 11; $i++) {
            for ($j=random_int(1,10); $j < 11; $j++) {
                DB::table('likes')->insert(
                    array(
                        'product_id'=> $i,
                        'user_id'=>$j
                    )
                );
            }  
        }       
    }
}
