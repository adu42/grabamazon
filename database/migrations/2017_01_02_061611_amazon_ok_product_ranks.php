<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AmazonOkProductRanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('amazon_ok_product_ranks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('product_id'); // 产品表id
            $table->string('asin'); //sku 码
            $table->string('rank'); // 排名
            $table->string('mbc'); // 跟卖数
            $table->string('reviews'); // 评论数
            $table->string('asks'); // 问答数
            $table->integer('catalog_id'); //分类表id
            $table->dateTime('update_time');
            $table->string('step'); // 抓的次数
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('amazon_ok_product_ranks');
    }
}
