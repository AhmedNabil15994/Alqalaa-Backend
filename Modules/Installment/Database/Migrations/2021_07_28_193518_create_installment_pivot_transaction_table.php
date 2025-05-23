<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstallmentPivotTransactionTable extends Migration {

	public function up()
	{
		Schema::create('installment_pivot_transaction', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('installment_id')->unsigned();
			$table->integer('transaction_id')->unsigned();
			$table->decimal('amount',10,3);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('installment_pivot_transaction');
	}
}