<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            array(
                'brand_name'=>'H&M',
                'company'=>'H&M fashion',
                'company_code'=>'860000',
                'bank_num'=>'4789909',
                'bank_name'=>"ACB - Ngan Hang A Chau",
                'bank_account_name'=>'H&M FASHION COMPANY',
                'phone_number'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'email'=>'hmfashion@gmail.com',
                'status'=>1,
            ),
            array(
                'brand_name'=>'Puma',
                'company'=>'Puma fashion',
                'company_code'=>'887000',
                'bank_num'=>'14667889675',
                'bank_name'=>"Ngan Hang TMCP Cong Thuong Viet Nam - Vietin Bank",
                'bank_account_name'=>'PUMA FASHION COMPANY',
                'phone_number'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'email'=>'pumafashion@gmail.com',
                'status'=>1,
            ),
            array(
                'brand_name'=>'Adidas',
                'company'=>'Adidas fashion',
                'company_code'=>'899000',
                'bank_num'=>'140089007766',
                'bank_name'=>"Ngan Hang TMCP Cong Thuong Viet Nam - Vietin Bank",
                'bank_account_name'=>'ADIDAS FASHION COMPANY',
                'phone_number'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'email'=>'adidasfashion@gmail.com',
                'status'=>1,
            ),
        ]);
    }
}
