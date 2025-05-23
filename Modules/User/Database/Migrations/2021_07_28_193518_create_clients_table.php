<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('nationality_id')->nullable();
			$table->string('name');
			$table->string('national_ID');
			$table->string('email')->nullable();
			$table->string('user_name');
			$table->string('pin_code')->nullable();
			$table->datetime('pin_code_date_expired')->nullable();
			$table->string('password')->nullable();
			$table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_judging')->default(0);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}