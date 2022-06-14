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
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>5.0,
                'description'=> '<p><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">Áo Thun Cổ Tròn Đơn Giản Y Nguyên Bản Ver52</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">Chất liệu: Cotton Compact</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">Thành phần: 100% Cotton</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">- Thân thiện</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">- Thấm hút thoát ẩm</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">- Mềm mại</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">- Kiểm soát mùi</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">- Điều hòa nhiệt</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">+ Họa tiết may miếng đắp</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">- HDSD:</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">+ Nên giặt chung với sản phẩm cùng màu</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">+ Không dùng thuốc tẩy hoặc xà phòng có tính tẩy mạnh</span><br><span style="background-color:rgb(255,255,255);color:rgb(16,16,16);">+ Nên phơi trong bóng râm để giữ sp bền màu</span></p>',
                'status'=>1
            ),
            array(
                'product_name'=>"Áo thun loan màu nam nữ cực đẹp",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,99)*10000,
                'vat'=>4,
                'discount_price'=>random_int(10,20)*1000,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>4.4,
                'description'=>'<p>Với thiết kế basic, phù hợp với mọi dáng vẻ của phái đẹp khi ở nhà, bộ ngủ tay con cùng quần dài 0380 phù hợp cho mặc nhà, mặc ngủ, mặc ra ngoài nhanh, thuận tiện mà vẫn đảm bảo sự lịch sự. Chất nylon cao cấp mềm mịn cùng họa tiết hoa nhỏ, sẵn sàng giúp bạn tự tin tận hưởng mỗi ngày.</p><ul><li>Kiểu dáng: Bộ dài tay con&nbsp;</li><li>Chất liệu: 90% Nylon, 10% Spandex</li><li>Kích cỡ: M, L, LL</li><li>Màu sắc: Cam in</li><li>Công dụng: Mặc nhà</li><li>Chất liệu cao cấp, an toàn và thân thiện với làn da, bảo vệ sức khỏe của người mặc</li><li>Sản xuất theo công nghệ Nhật Bản</li></ul> ',
                'status'=>1
            ),
            array(
                'product_name'=>"Giày jordan nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>3.8,
                'description'=>'<p><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">Miêu tả: ĐẦM LỬNG CỔ VEST.</span><br><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">&nbsp;</span></p><p>Đặc tính: Nữ tính - Thanh lịch.<br>&nbsp;</p><p>Thể loại: Trang phục công sở.</p><p>Size: S/M/L.<br>&nbsp;</p><p>Chất liệu: Vải poly tổng hợp.<br>&nbsp;</p><p>Màu sắc: Đen/Xanh/Hồng.<br>&nbsp;</p><p>Lưu ý: Không tẩy, ngâm. Giặt tay. Ủi hơi nước.</p><p>Số đo mẫu nữ: Chiều cao: 168 cm. Số đo 3 vòng: 83 - 59 - 86 (Mặc size S).</p>',
                'status'=>1
            ),
            array(
                'product_name'=>"Váy gấm xòe cổ vuông",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>random_int(10,20)*1000,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>1.5,
                'description'=>'<p><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">Miêu tả: CHÂN VÁY MINI KIỂU XẾP ĐẮP.</span><br><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">&nbsp;</span></p><p>Đặc tính: Trẻ trung - Nữ tính.</p><p><br>Thể loại: Trang phục dạo phố..<br>&nbsp;</p><p>Size: S/M/L.<br>&nbsp;</p><p>Chất liệu: Vải sợi cotton gân.<br>&nbsp;</p><p>Màu sắc: Kem/Đen<br>&nbsp;</p><p>Lưu ý: Không tẩy, ngâm. Giặt tay. Ủi hơi nước. Không giặt chung với những sản phẩm dễ gây xước khác.</p><p>Số đo mẫu nữ: Chiều cao: 168 cm. Số đo 3 vòng: 83 - 59 - 86 (Mặc size S).</p>',
                'status'=>1
            ),
            array(
                'product_name'=>"Áo croptop tay phồng",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>2.3,
                'description'=>'<p>Với thiết kế basic, phù hợp với mọi dáng vẻ của phái đẹp khi ở nhà, bộ ngủ tay con cùng quần dài 0380 phù hợp cho mặc nhà, mặc ngủ, mặc ra ngoài nhanh, thuận tiện mà vẫn đảm bảo sự lịch sự. Chất nylon cao cấp mềm mịn cùng họa tiết hoa nhỏ, sẵn sàng giúp bạn tự tin tận hưởng mỗi ngày.</p><ul><li>Kiểu dáng: Bộ dài tay con&nbsp;</li><li>Chất liệu: 90% Nylon, 10% Spandex</li><li>Kích cỡ: M, L, LL</li><li>Màu sắc: Cam in</li><li>Công dụng: Mặc nhà</li><li>Chất liệu cao cấp, an toàn và thân thiện với làn da, bảo vệ sức khỏe của người mặc</li><li>Sản xuất theo công nghệ Nhật Bản</li></ul> ',
                'status'=>1
            ),
            array(
                'product_name'=>"Áo thun form rộng nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>random_int(10,20)*1000,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>3.6,
                'description'=>'<p>Với thiết kế basic, phù hợp với mọi dáng vẻ của phái đẹp khi ở nhà, bộ ngủ tay con cùng quần dài 0380 phù hợp cho mặc nhà, mặc ngủ, mặc ra ngoài nhanh, thuận tiện mà vẫn đảm bảo sự lịch sự. Chất nylon cao cấp mềm mịn cùng họa tiết hoa nhỏ, sẵn sàng giúp bạn tự tin tận hưởng mỗi ngày.</p><ul><li>Kiểu dáng: Bộ dài tay con&nbsp;</li><li>Chất liệu: 90% Nylon, 10% Spandex</li><li>Kích cỡ: M, L, LL</li><li>Màu sắc: Cam in</li><li>Công dụng: Mặc nhà</li><li>Chất liệu cao cấp, an toàn và thân thiện với làn da, bảo vệ sức khỏe của người mặc</li><li>Sản xuất theo công nghệ Nhật Bản</li></ul> ',
                'status'=>1
            ),
            array(
                'product_name'=>"Áo khoác nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>4.2,
                'description'=>'<p><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">Miêu tả: ĐẦM LỬNG CỔ VEST.</span><br><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">&nbsp;</span></p><p>Đặc tính: Nữ tính - Thanh lịch.<br>&nbsp;</p><p>Thể loại: Trang phục công sở.</p><p>Size: S/M/L.<br>&nbsp;</p><p>Chất liệu: Vải poly tổng hợp.<br>&nbsp;</p><p>Màu sắc: Đen/Xanh/Hồng.<br>&nbsp;</p><p>Lưu ý: Không tẩy, ngâm. Giặt tay. Ủi hơi nước.</p><p>Số đo mẫu nữ: Chiều cao: 168 cm. Số đo 3 vòng: 83 - 59 - 86 (Mặc size S).</p>',
                'status'=>1
            ),
            array(
                'product_name'=>"Áo thun loan màu nam nữ cực đẹp",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>random_int(10,20)*1000,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>5.0,
                'description'=>'<p><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">Miêu tả: CHÂN VÁY MINI KIỂU XẾP ĐẮP.</span><br><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">&nbsp;</span></p><p>Đặc tính: Trẻ trung - Nữ tính.</p><p><br>Thể loại: Trang phục dạo phố..<br>&nbsp;</p><p>Size: S/M/L.<br>&nbsp;</p><p>Chất liệu: Vải sợi cotton gân.<br>&nbsp;</p><p>Màu sắc: Kem/Đen<br>&nbsp;</p><p>Lưu ý: Không tẩy, ngâm. Giặt tay. Ủi hơi nước. Không giặt chung với những sản phẩm dễ gây xước khác.</p><p>Số đo mẫu nữ: Chiều cao: 168 cm. Số đo 3 vòng: 83 - 59 - 86 (Mặc size S).</p>',
                'status'=>1
            ),
            array(
                'product_name'=>"Giày jordan nam nữ",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>0,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>3.5,
                'description'=>'<p>Với thiết kế basic, phù hợp với mọi dáng vẻ của phái đẹp khi ở nhà, bộ ngủ tay con cùng quần dài 0380 phù hợp cho mặc nhà, mặc ngủ, mặc ra ngoài nhanh, thuận tiện mà vẫn đảm bảo sự lịch sự. Chất nylon cao cấp mềm mịn cùng họa tiết hoa nhỏ, sẵn sàng giúp bạn tự tin tận hưởng mỗi ngày.</p><ul><li>Kiểu dáng: Bộ dài tay con&nbsp;</li><li>Chất liệu: 90% Nylon, 10% Spandex</li><li>Kích cỡ: M, L, LL</li><li>Màu sắc: Cam in</li><li>Công dụng: Mặc nhà</li><li>Chất liệu cao cấp, an toàn và thân thiện với làn da, bảo vệ sức khỏe của người mặc</li><li>Sản xuất theo công nghệ Nhật Bản</li></ul> ',
                'status'=>1
            ),
            array(
                'product_name'=>"Váy gấm xòe cổ vuông",
                'stock'=>random_int(5,10)*10,
                'import_price'=>random_int(10,20)*10000-50000,
                'price'=>random_int(10,20)*10000,
                'vat'=>4,
                'discount_price'=>random_int(10,20)*1000,
                'product_type_id'=>random_int(1,5),
                'product_barcode'=>'14578886'.random_int(100,999),
                'brand_id'=>random_int(1,3),
                'popular'=>random_int(0,1),
                'num_like'=>random_int(0,10),
                'num_rate'=>4.7,
                'description'=>'<p><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">Miêu tả: ĐẦM LỬNG CỔ VEST.</span><br><span style="background-color:rgb(255,255,255);color:rgb(68,68,68);">&nbsp;</span></p><p>Đặc tính: Nữ tính - Thanh lịch.<br>&nbsp;</p><p>Thể loại: Trang phục công sở.</p><p>Size: S/M/L.<br>&nbsp;</p><p>Chất liệu: Vải poly tổng hợp.<br>&nbsp;</p><p>Màu sắc: Đen/Xanh/Hồng.<br>&nbsp;</p><p>Lưu ý: Không tẩy, ngâm. Giặt tay. Ủi hơi nước.</p><p>Số đo mẫu nữ: Chiều cao: 168 cm. Số đo 3 vòng: 83 - 59 - 86 (Mặc size S).</p>',
                'status'=>1
            ),
        ]);

    }
}
