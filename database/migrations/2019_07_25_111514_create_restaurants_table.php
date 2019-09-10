<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('district_id');
			$table->string('image');
			$table->string('name');
			$table->decimal('minimum_charge', 8,2);
			$table->decimal('delivery', 8,2);
			$table->string('phone');
			$table->string('whatsapp');
			$table->string('email');
			$table->string('password');
			$table->timestamps();
			$table->enum('status', array('0', '1'))->default('0');
			$table->tinyInteger('activated')->default(1);
			$table->string('api_token')->unique()->nullable();
			$table->string('pin_code')->nullable();

		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}