<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('restaurant_id');
			$table->decimal('paid', 8,2);
			$table->decimal('remaining', 8,2)->nullable();
			$table->timestamps();
			$table->string('notes')->nullable();

		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}