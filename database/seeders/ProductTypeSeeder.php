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
        for ($i=0; $i < 5; $i++) {
            DB::table('products')->insert([
                'productTypeName'=>Str::random(20),
                'categoryId'=>random_int(1,5),
                'status'=>1
            ]);
        }
    }
}
