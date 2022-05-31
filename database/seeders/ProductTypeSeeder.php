<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            array(
                'product_type_name'=>'Áo thun',
                'categorie_id'=>1,
                'status'=>1
            ),
            array(
                'product_type_name'=>'Áo khoác',
                'categorie_id'=>1,
                'status'=>1
            ),
            array(
                'product_type_name'=>'T-Shirt',
                'categorie_id'=>1,
                'status'=>1
            ),
            array(
                'product_type_name'=>'Quần tây',
                'categorie_id'=>2,
                'status'=>1
            ),
            array(
                'product_type_name'=>'Quần thun',
                'categorie_id'=>2,
                'status'=>1
            ),
            array(
                'product_type_name'=>'Quần short',
                'categorie_id'=>2,
                'status'=>1
            ),
            array(
                'product_type_name'=>'Đầm tây',
                'categorie_id'=>3,
                'status'=>1
            ),
            array(
                'product_type_name'=>'Đầm thun',
                'categorie_id'=>3,
                'status'=>1
            ),
            array(
                'product_type_name'=>'Đầm short',
                'categorie_id'=>3,
                'status'=>1
            ),
        ]);
    }
}
