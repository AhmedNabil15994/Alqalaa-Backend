<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstallmentOffersHistoryTable extends Migration {

	public function up()
	{
		Schema::create('installment_offers_history', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('installment_id')->unsigned();
			$table->decimal('amount',10,3);
			$table->decimal('remaining',10,3)->default('0');
			$table->decimal('paid',10,3)->default('0');
            $table->float("offer_percentage");
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('installment_offers_history');
	}
}