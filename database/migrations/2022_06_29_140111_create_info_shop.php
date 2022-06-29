<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_shop', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->text('address_map')->nullable();
            $table->string('phone')->nullable();
            $table->text('mess_manager')->nullable();
            $table->text('mess_chat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_shop');
    }
}
