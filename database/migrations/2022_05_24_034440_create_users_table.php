<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->string('password');
            $table->string('address');
            $table->string('avatar');
            $table->unsignedBigInteger('role_id')->unsigned();//0.user, 1.admin, 2.staff
            $table->tinyInteger('status');//0.inactive, 1.active
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });
        // Schema::table('users', function($table) {
        //     $table->foreign('role-id')->references('id')->on('roles');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
