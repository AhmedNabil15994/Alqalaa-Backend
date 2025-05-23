<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstallmentPaymentsTable extends Migration {

	public function up()
	{
		Schema::create('installment_payments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('installment_id')->unsigned();
			$table->decimal('amount',10,3);
			$table->text('note')->nullable();
			$table->date('transaction_date');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('installment_payments');
	}
}