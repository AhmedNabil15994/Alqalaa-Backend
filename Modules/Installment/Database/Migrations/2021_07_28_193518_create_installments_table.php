<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstallmentsTable extends Migration {

	public function up()
	{
		Schema::create('installments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contract_id')->unsigned();
			$table->decimal('amount',10,3);
			$table->decimal('remaining',10,3)->default('0');
			$table->decimal('paid',10,3)->default('0');
			$table->date('due_date');
			$table->date('transaction_date')->nullable();
			$table->text('note')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('installments');
	}
}