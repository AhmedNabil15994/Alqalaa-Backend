<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPayByAndTypeInstallmentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_payments', function (Blueprint $table) {
            $table->enum("pay_by_type",['by_link','by_admin'])->nullable();
            $table->integer("pay_by_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_payments', function (Blueprint $table) {
            $table->dropColumn(["pay_by_type","pay_by_id"]);
        });
    }
}
