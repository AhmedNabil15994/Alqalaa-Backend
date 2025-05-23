<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentTransactionsTokenColsTable extends Migration {

	public function up()
	{
		Schema::table('installment_transactions', function($table) {
			$table->string('token')->nullable();
		});
	}

	public function down()
	{
        Schema::table('installment_transactions', function($table) {
            $table->dropColumn('token');
        });
	}
}
