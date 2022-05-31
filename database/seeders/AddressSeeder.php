<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            array(
                'user-id'=>1,
                'address'=>'Ho Chi Minh city',
                'phoneNumber'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'isDefault'=>1
            ),
            array(
                'user-id'=>1,
                'address'=>'Ben Tre',
                'phoneNumber'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'isDefault'=>0
            ),
            array(
                'user-id'=>1,
                'address'=>'Dong Nai',
                'phoneNumber'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'isDefault'=>0
            ),
        ]);
    }
}
