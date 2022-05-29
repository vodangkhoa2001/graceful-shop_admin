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
        for ($i=0; $i < 3; $i++) {
            DB::table('products')->insert([
                'roleValue'=>Str::random(20),
                'roleName'=>random_int(1,5),
                'status'=>1
            ]);
        }
    }
}
