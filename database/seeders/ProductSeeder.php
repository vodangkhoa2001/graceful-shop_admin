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

            DB::table('products')->insert([
                array(
                    'productName'=>"Áo khoác nam nữ",
                    'stock'=>random_int(5,10)*10,
                    'importPrice'=>random_int(1,9)*100000-50000,
                    'price'=>random_int(1,9)*100000,
                    'vat'=>4,
                    'discountPrice'=>0,
                    'productTypeId'=>random_int(1,10),
                    'productQRCode'=>'14578886'.random_int(100,999),
                    'brandId'=>random_int(1,10),
                    'popular'=>0,
                    'numLike'=>random_int(0,100),
                    'numRate'=>random_int(0,100),
                    'description'=>Str::random(50),
                    'status'=>1
                ),
                array(
                    'productName'=>"Áo thun loan màu nam nữ cực đẹp",
                    'stock'=>random_int(5,10)*10,
                    'importPrice'=>random_int(1,9)*100000-50000,
                    'price'=>random_int(1,9)*100000,
                    'vat'=>4,
                    'discountPrice'=>0,
                    'productTypeId'=>random_int(1,10),
                    'productQRCode'=>'14578886'.random_int(100,999),
                    'brandId'=>random_int(1,10),
                    'popular'=>0,
                    'numLike'=>random_int(0,100),
                    'numRate'=>random_int(0,100),
                    'description'=>Str::random(50),
                    'status'=>1
                ),
                array(
                    'productName'=>"Giày jordan nam nữ",
                    'stock'=>random_int(5,10)*10,
                    'importPrice'=>random_int(1,9)*100000-50000,
                    'price'=>random_int(1,9)*100000,
                    'vat'=>4,
                    'discountPrice'=>0,
                    'productTypeId'=>random_int(1,10),
                    'productQRCode'=>'14578886'.random_int(100,999),
                    'brandId'=>random_int(1,10),
                    'popular'=>0,
                    'numLike'=>random_int(0,100),
                    'numRate'=>random_int(0,100),
                    'description'=>Str::random(50),
                    'status'=>1
                ),
                array(
                    'productName'=>"Váy gấm xòe cổ vuông",
                    'stock'=>random_int(5,10)*10,
                    'importPrice'=>random_int(1,9)*100000-50000,
                    'price'=>random_int(1,9)*100000,
                    'vat'=>4,
                    'discountPrice'=>0,
                    'productTypeId'=>random_int(1,10),
                    'productQRCode'=>'14578886'.random_int(100,999),
                    'brandId'=>random_int(1,10),
                    'popular'=>0,
                    'numLike'=>random_int(0,100),
                    'numRate'=>random_int(0,100),
                    'description'=>Str::random(50),
                    'status'=>1
                ),
                array(
                    'productName'=>"Áo croptop tay phồng",
                    'stock'=>random_int(5,10)*10,
                    'importPrice'=>random_int(1,9)*100000-50000,
                    'price'=>random_int(1,9)*100000,
                    'vat'=>4,
                    'discountPrice'=>0,
                    'productTypeId'=>random_int(1,10),
                    'productQRCode'=>'14578886'.random_int(100,999),
                    'brandId'=>random_int(1,10),
                    'popular'=>0,
                    'numLike'=>random_int(0,100),
                    'numRate'=>random_int(0,100),
                    'description'=>Str::random(50),
                    'status'=>1
                ),
                array(
                    'productName'=>"Áo thun form rộng nam nữ",
                    'stock'=>random_int(5,10)*10,
                    'importPrice'=>random_int(1,9)*100000-50000,
                    'price'=>random_int(1,9)*100000,
                    'vat'=>4,
                    'discountPrice'=>0,
                    'productTypeId'=>random_int(1,10),
                    'productQRCode'=>'14578886'.random_int(100,999),
                    'brandId'=>random_int(1,10),
                    'popular'=>0,
                    'numLike'=>random_int(0,100),
                    'numRate'=>random_int(0,100),
                    'description'=>Str::random(50),
                    'status'=>1
                ),
            ]);

    }
}
