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
                'roleValue'=>0,
                'roleName'=>'User',
                'status'=>1
            ),
            array(
                'roleValue'=>1,
                'roleName'=>'Admin',
                'status'=>1
            ),
            array(
                'roleValue'=>2,
                'roleName'=>'Quản lý kho',
                'status'=>1
            ),
            array(
                'roleValue'=>3,
                'roleName'=>'CSKH',
                'status'=>1
            ),
        ]);
    }
}
