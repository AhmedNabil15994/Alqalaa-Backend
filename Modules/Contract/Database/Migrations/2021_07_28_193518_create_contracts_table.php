<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractsTable extends Migration {

	public function up()
	{
		Schema::create('contracts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->integer('month_percentage_id')->unsigned()->nullable();
            $table->integer('case_action_id')->unsigned()->nullable();
            $table->enum('type',['contract','indebtednes'])->default('contract');
			$table->date('transaction_date')->nullable();
			$table->decimal('price',10,3);
			$table->decimal('down_payment',10,3)->nullable();
			$table->decimal('remaining',10,3);
			$table->decimal('installment_fees',10,3)->default(0);
			$table->decimal('installment_with_fees',10,3)->default(0);
			$table->integer('months_num')->nullable();
			$table->decimal('installment_value',10,3)->nullable();
			$table->text('note')->nullable();
			$table->date('completed_at')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contracts');
	}
}