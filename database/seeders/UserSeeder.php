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
                'full_name'=>Str::random(10),
                'email'=>Str::random(10).'@gmail.com',
                'phone'=> '0987'.random_int(100000,999999),
                'password'=>Hash::make('password'),
                'address'=> Str::random(10).', '.Str::random(10),
                'avatar'=>'default_avatar.png',
                'role_id'=>random_int(1,4),
                'status'=>1,
            ]);
        }
    }

}
