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
                'productTypeName'=>'Áo thun',
                'categorie-id'=>1,
                'status'=>1
            ),
            array(
                'productTypeName'=>'Áo khoác',
                'categorie-id'=>1,
                'status'=>1
            ),
            array(
                'productTypeName'=>'Quần tây',
                'categorie-id'=>2,
                'status'=>1
            ),
            array(
                'productTypeName'=>'Quần thun',
                'categorie-id'=>2,
                'status'=>1
            ),
            array(
                'productTypeName'=>'Quần short',
                'categorie-id'=>2,
                'status'=>1
            ),
        ]);
    }
}
