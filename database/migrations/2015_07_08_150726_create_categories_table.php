<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Ado\Models\Constuct\NestedSet;

class CreateCategoriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('url_key');
            $table->string('title');
            $table->string('keywords');
            $table->text('description');
            $table->boolean('in_top');
            $table->boolean('is_active');
            $table->string('image');
            NestedSet::columns($table);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
