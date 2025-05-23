<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMonthPercentagesTable extends Migration {

	public function up()
	{
		Schema::create('month_percentages', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('month_number');
			$table->float('presentage');
			$table->tinyInteger('status')->default(1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('month_percentages');
	}
}