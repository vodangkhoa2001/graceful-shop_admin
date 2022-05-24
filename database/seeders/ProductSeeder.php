<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            DB::table('products')->insert([
                'productId'=>Str::random(10),
                'productName'=>Str::random(50),
                'stock'=>random_int(5,10)*10,
                'importPrice'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discountPrice'=>0,
                'productTypeId'=>random_int(1,10),
                'productQRCode'=>'14578886'.random_int(100,999),
                'brandId'=>random_int(1,10),
                'numLike'=>random_int(0,100),
                'numRate'=>random_int(0,100),
                'status'=>1
            ]);
        }
    }
}
