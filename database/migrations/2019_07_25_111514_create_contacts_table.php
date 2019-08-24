<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('message');
			$table->enum('type', array('complaint','suggestion','enquiry'));
			$table->timestamps();
			$table->string('contactable_type')->nullable();
			$table->integer('contactable_id')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}