<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabelsTable extends Migration {

	public function up()
	{
		Schema::create('labels', function(Blueprint $table) {
			$table->increments('id');
            	$table->json('title');
			$table->string('color');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('labels');
	}
}