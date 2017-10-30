<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Block extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('block', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('identifier');
            $table->string('title');
            $table->string('flag')->index();
            $table->string('lang');
            $table->text('content');
            $table->boolean('enable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('block');
    }
}
