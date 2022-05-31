<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            array(
                'role_value'=>0,
                'role_name'=>'User',
                'status'=>1
            ),
            array(
                'role_value'=>1,
                'role_name'=>'Admin',
                'status'=>1
            ),
            array(
                'role_value'=>2,
                'role_name'=>'Quản lý kho',
                'status'=>1
            ),
            array(
                'role_value'=>3,
                'role_name'=>'CSKH',
                'status'=>1
            ),
        ]);
    }
}
