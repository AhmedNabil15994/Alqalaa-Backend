<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstallmentTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('installment_transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->decimal('amount',10,3);
			$table->tinyInteger('paid')->nullable();
			$table->json('response')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('installment_transactions');
	}
}