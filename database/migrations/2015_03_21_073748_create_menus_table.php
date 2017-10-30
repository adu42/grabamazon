<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Ado\Models\Constuct\NestedSet;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Menus', function(Blueprint $table)
		{
            $table->increments('id')->auto_increment(2);
           // $table->integer('store_id');
            $table->string('name');
            $table->string('description');
          //  $table->string('path');
            $table->string('url_key');
            $table->string('image');
         //   $table->integer('sort_order');
        //    $table->integer('parent_id');
           // $table->integer('position');
            $table->boolean('is_active');
            $table->boolean('in_top');
          //  $table->boolean('level');
            NestedSet::columns($table);
          //  $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menus');
	}

}
