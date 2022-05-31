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
            $table->string('product_name');
            $table->integer('stock');
            $table->integer('import_price');
            $table->integer('price');
            $table->double('vat');
            $table->integer('discount_price');
            $table->unsignedBigInteger('product_type_id');
            $table->string('product_barcode');
            $table->unsignedBigInteger('brand_id');
            $table->tinyInteger('popular');
            $table->integer('num_like');
            $table->integer('num_rate');
            $table->text('description', 64);
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('brand_id')->references('id')->on('brands');
            // $table->foreign('productType_id')->references('id')->on('product_types');
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
