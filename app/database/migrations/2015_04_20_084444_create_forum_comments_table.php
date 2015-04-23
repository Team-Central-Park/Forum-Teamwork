<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('forum_comments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('body');
            $table->integer('rating')->default(0);
            $table->integer('thread_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('thread_id')->references('id')->on('forum_threads')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('forum_comments');
	}

}
