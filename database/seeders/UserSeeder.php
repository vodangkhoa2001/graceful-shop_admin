<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for($i=0;$i<10;$i++){
            DB::table('users')->insert([
                'fullName'=>Str::random(10),
                'email'=>Str::random(10).'@gmail.com',
                'phoneNumber'=> '0987'.random_int(100000,999999),
                'password'=>Hash::make('password'),
                'address'=> Str::random(10).', '.Str::random(10),
                'avatar'=>'default_avatar.png',
                'role'=>random_int(0,2),
                'status'=>1,
            ]);
        }
    }

}
