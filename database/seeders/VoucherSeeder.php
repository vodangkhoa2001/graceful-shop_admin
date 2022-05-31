<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vouchers')->insert([
            array(
                'voucher_code'=>'CHAOTHANG6',
                'description'=>'Áp dụng cho đơn hàng có giá trị từ 50.000 trở lên',
                'discount_price'=>20000,
                'end_date'=>'14/06/2022',
                'status'=>1,
            ),
        ]);
    }
}
