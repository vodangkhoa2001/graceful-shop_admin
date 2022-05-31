<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName');
            $table->integer('stock');
            $table->integer('importPrice');
            $table->integer('price');
            $table->double('vat');
            $table->integer('discountPrice');
            $table->unsignedBigInteger('productType-id');
            $table->string('productBarCode');
            $table->unsignedBigInteger('brand-id');
            $table->tinyInteger('popular');
            $table->integer('numLike');
            $table->integer('numRate');
            $table->text('description', 64);
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('brand-id')->references('id')->on('brands');
            // $table->foreign('productType-id')->references('id')->on('product_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
