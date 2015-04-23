<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('forum_categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->integer('group_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('forum_groups')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('forum_categories');
	}

}
