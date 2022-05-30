<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_details')->insert([
            array(
                'product-id'=>1,
                'color-id'=>1,
                'size-id'=>1,
                'quantity'=>random_int(1,99)
            ),
            array(
                'product-id'=>1,
                'color-id'=>2,
                'size-id'=>1,
                'quantity'=>random_int(1,99)
            ),
            array(
                'product-id'=>1,
                'color-id'=>1,
                'size-id'=>2,
                'quantity'=>random_int(1,99)
            ),
        ]);
    }
}
