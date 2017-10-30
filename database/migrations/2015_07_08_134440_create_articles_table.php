<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->string('url_key')->index();
            $table->string('meta_keywords');
            $table->string('meta_description');
            $table->string('content_heading');
            $table->text('content');
            $table->boolean('is_active');
            $table->integer('author_id');
            $table->integer('sort_order');
			$table->integer('top');
            $table->integer('hits');
            $table->boolean('share');
            $table->string('tags');
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
		Schema::drop('articles');
	}

}
