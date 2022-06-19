<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'voucher_code'=>'02DATT2022',
                'description'=>'Giảm 20000 cho đơn hàng có giá trị từ 150.000 trở lên',
                'min_total_price'=> 150000,
                'discount_price'=>20000,
                'start_date'=>Carbon::create(2022, 06, 01),
                'end_date'=>Carbon::create(2022, 06, 06),
                'status'=>1,
            ),
            array(
                'voucher_code'=>'02DATT2022',
                'description'=>'Giảm 49000 cho đơn hàng có giá trị từ 399.000 trở lên',
                'min_total_price'=> 399000,
                'discount_price'=>49000,
                'start_date'=>Carbon::create(2022, 06, 15),
                'end_date'=>Carbon::create(2022, 06, 30),
                'status'=>1,
            ),
            array(
                'voucher_code'=>'02DATT2022',
                'description'=>'Giảm 39000 cho đơn hàng có giá trị từ 149.000 trở lên',
                'min_total_price'=> 150000,
                'discount_price'=>39000,
                'start_date'=>Carbon::create(2022, 07, 01),
                'end_date'=>Carbon::create(2022, 07, 07),
                'status'=>1,
            ),
        ]);
    }
}
