<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractStatusesTable extends Migration {

	public function up()
	{
		Schema::create('contract_statuses', function(Blueprint $table) {
			$table->increments('id');
			$table->json('title');
			$table->boolean('is_pending')->default(false);
			$table->boolean('is_active')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contract_statuses');
	}
}