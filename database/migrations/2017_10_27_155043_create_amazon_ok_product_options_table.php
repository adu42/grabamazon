<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonOkProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_ok_product_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label')->nullable()->index();  //标题
            $table->string('field_type')->nullable(); //表单类型
            $table->string('value')->nullable(); //值
            $table->integer('sort_order')->default(0); //排序
        });
        Schema::create('amazon_ok_product_option_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('option_id')->nullable()->index();  //关联属性
            $table->string('label')->nullable();  //标题
            $table->text('format')->nullable();  //内容
            $table->text('format_value')->nullable();  //内容
            $table->integer('sort_order')->default(0); //排序
            $table->boolean('is_default')->default(0); //默认
            $table->foreign('option_id')
                ->references('id')->on('amazon_ok_product_options')
                ->onDelete('cascade');
        });
        Schema::create('amazon_ok_product_option_provs', function (Blueprint $table) {
            $table->integer('product_id')->index();
            $table->integer('option_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amazon_ok_product_options');
    }
}
