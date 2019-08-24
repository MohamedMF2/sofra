<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->integer('restaurant_id');
			$table->enum('rate', array('1', '2', '3', '4', '5'));
			$table->string('comment')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}