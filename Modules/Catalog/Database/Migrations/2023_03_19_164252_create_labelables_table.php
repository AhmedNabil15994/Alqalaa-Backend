<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabelablesTable extends Migration {

	public function up()
	{
		Schema::create('labelables', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('label_id');
			$table->string('labelable_type');
			$table->integer('labelable_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('labelables');
	}
}