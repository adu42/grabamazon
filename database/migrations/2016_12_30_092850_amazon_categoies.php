<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AmazonCategoies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_categoies', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->string('label');
            $table->string('keywords');
            $table->text('description');
            $table->boolean('in_hot');
            $table->boolean('in_focus');
            $table->boolean('is_active');
            $table->integer('links');
            $table->integer('step');
            $table->dateTime('update_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('amazon_categoies');
    }
}
