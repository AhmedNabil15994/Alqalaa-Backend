<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientPhonesTable extends Migration {

	public function up()
	{
		Schema::create('client_phones', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->string('code')->nullable();
			$table->string('phone');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('client_phones');
	}
}