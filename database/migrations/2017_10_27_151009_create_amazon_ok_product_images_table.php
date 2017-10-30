<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonOkProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_ok_product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->index();
            $table->string('label')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amazon_ok_product_images');
    }
}
