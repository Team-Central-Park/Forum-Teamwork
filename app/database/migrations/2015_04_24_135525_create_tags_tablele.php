<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTablele extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->integer('thread_id')->unsigned();
			$table->string('tag', 50);

            $table->foreign('thread_id')->references('id')->on('forum_threads')->onDelete('cascade');
            $table->primary(['thread_id', 'tag']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
	}

}
