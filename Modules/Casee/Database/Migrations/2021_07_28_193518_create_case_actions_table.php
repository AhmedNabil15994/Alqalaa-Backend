<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCaseActionsTable extends Migration {

	public function up()
	{
		Schema::create('case_actions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->longText('description')->nullable();
			$table->float('price')->nullable();
			$table->boolean('paid')->default(false);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('case_actions');
	}
}