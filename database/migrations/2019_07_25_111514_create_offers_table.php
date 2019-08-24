<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id')->nullable();
			$table->string('image');
			$table->string('name');
			$table->string('description')->nullable();
			$table->dateTime('start');
			$table->dateTime('end');
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}