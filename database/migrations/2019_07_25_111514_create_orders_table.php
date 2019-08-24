<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->integer('restaurant_id');
			$table->string('address');
			$table->string('phone')->nullable();
			$table->string('notes')->nullable();
			$table->decimal('total', 8,2)->nullable();
			$table->decimal('cost', 8,2)->nullable();
			$table->string('payment')->default('cash');
			$table->enum('status', array('pending', 'accepted', 'rejected', 'delivered', 'declined'));
			$table->decimal('commission', 8,2)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}