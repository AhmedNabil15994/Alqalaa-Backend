<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	public function up()
	{
		Schema::create('addresses', function(Blueprint $table) {
			$table->increments('id');
            $table->unsignedBigInteger('state_id')->nullable();
			$table->integer('client_id')->unsigned();
			$table->string('zone')->nullable();
			$table->string('street');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('addresses');
	}
}