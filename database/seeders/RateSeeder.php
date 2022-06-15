<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for($i=1;$i<11;$i++){
            for($j=1;$j<random_int(1,11);$j++){
                DB::table('rates')->insert([
                    'product_id'=>$i,
                    'user_id'=>$j,
                    'num_rate'=> random_int(1,5),
                    'description'=> $j%2==0?'Sản phẩm này đẹp quá! mê mê':'Sản phẩm quá tuyệt vời',
                    'created_at'=> Carbon::now(),
                ]);
            }
        }
    }

}
