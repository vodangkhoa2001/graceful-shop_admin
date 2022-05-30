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
                'brandName'=>'H&M',
                'company'=>'H&M fashion',
                'companyCode'=>'860000',
                'bankNum'=>'4789909',
                'bankName'=>"ACB - Ngan Hang A Chau",
                'bankAccountName'=>'H&M FASHION COMPANY',
                'phoneNumber'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'email'=>'hmfashion@gmail.com',
                'status'=>1,
            ),
            array(
                'brandName'=>'Puma',
                'company'=>'Puma fashion',
                'companyCode'=>'887000',
                'bankNum'=>'14667889675',
                'bankName'=>"Ngan Hang TMCP Cong Thuong Viet Nam - Vietin Bank",
                'bankAccountName'=>'PUMA FASHION COMPANY',
                'phoneNumber'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'email'=>'pumafashion@gmail.com',
                'status'=>1,
            ),
            array(
                'brandName'=>'Adidas',
                'company'=>'Adidas fashion',
                'companyCode'=>'899000',
                'bankNum'=>'140089007766',
                'bankName'=>"Ngan Hang TMCP Cong Thuong Viet Nam - Vietin Bank",
                'bankAccountName'=>'ADIDAS FASHION COMPANY',
                'phoneNumber'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'email'=>'adidasfashion@gmail.com',
                'status'=>1,
            ),
        ]);
    }
}
