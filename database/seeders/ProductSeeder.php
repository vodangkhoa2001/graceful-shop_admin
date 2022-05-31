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
                'product_name'=>"Áo khoác nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Áo thun loan màu nam nữ cực đẹp",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Giày jordan nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Váy gấm xòe cổ vuông",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Áo croptop tay phồng",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Áo thun form rộng nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Áo khoác nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Áo thun loan màu nam nữ cực đẹp",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Giày jordan nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
            array(
                'product_name'=>"Váy gấm xòe cổ vuông",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(1,9)*100000-50000,
                'price'=>random_int(1,9)*100000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,100),
                'num_rate'=>random_int(0,100),
                'description'=>Str::random(50),
                'status'=>1
            ),
        ]);

    }
}
