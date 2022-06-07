<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            array(
                'picture'=>'slide_01.jpg',
                'description'=>'<h3 style="text-align:center;"><span style="color:hsl(30, 75%, 60%);">[Graceful_Shop best saller 30%]</span></h3><p><span style="color:hsl(0, 0%, 0%);">Chi tiết chương trình</span></p><p>❤️Voucher 30% cho tất cả sản phẩm dưới đây</p><p>👉Thời gian từ 01/06 - 06/06/2022</p><blockquote><p>👉Truy cập shop tại: graceful.shop.vn</p></blockquote>',
                'status'=>1,
            ),
            array(
                'picture'=>'slide_02.jpg',
                'description'=>'<h3 style="text-align:center;"><span style="color:hsl(30, 75%, 60%);">[Mùa hè đến rồi]</span></h3><p><span style="color:hsl(0, 0%, 0%);">Nhanh tay chọn những sản phẩm yêu thích đi nào</span></p><p>😍Sản phẩm siêu hot mùa này</p>👉Truy cập shop tại: graceful.shop.vn</p></blockquote>',
                'status'=>1,
            ),
        ]);
    }
}
