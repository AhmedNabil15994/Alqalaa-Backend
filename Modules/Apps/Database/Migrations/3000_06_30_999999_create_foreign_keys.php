<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('nationality_id')->references('id')->on('nationalities')
                ->onDelete('set null')
                ->onUpdate('restrict');
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('state_id')->references('id')->on('states')
                ->onDelete('set null')
                ->onUpdate('restrict');
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('client_phones', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreign('month_percentage_id')->references('id')->on('month_percentages')
                ->onDelete('set null')
                ->onUpdate('restrict');
        });
        Schema::table('installments', function (Blueprint $table) {
            $table->foreign('contract_id')->references('id')->on('contracts')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('installment_payments', function (Blueprint $table) {
            $table->foreign('installment_id')->references('id')->on('installments')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('installment_pivot_transaction', function (Blueprint $table) {
            $table->foreign('installment_id')->references('id')->on('installments')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('installment_pivot_transaction', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('installment_transactions')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('case_actions', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign('clients_nationality_id_foreign');
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign('addresses_state_id_foreign');
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign('addresses_client_id_foreign');
        });
        Schema::table('client_phones', function (Blueprint $table) {
            $table->dropForeign('client_phones_client_id_foreign');
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign('contracts_client_id_foreign');
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign('contracts_month_percentage_id_foreign');
        });
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropForeign('user_profiles_state_id_foreign');
        });
        Schema::table('installments', function (Blueprint $table) {
            $table->dropForeign('installments_contract_id_foreign');
        });
        Schema::table('installment_payments', function (Blueprint $table) {
            $table->dropForeign('installment_payments_installment_id_foreign');
        });
        Schema::table('case_actions', function (Blueprint $table) {
            $table->dropForeign('case_actions_client_id_foreign');
        });
        Schema::table('installment_pivot_transaction', function (Blueprint $table) {
            $table->dropForeign('installment_pivot_transaction_installment_id_foreign');
        });
        Schema::table('installment_pivot_transaction', function (Blueprint $table) {
            $table->dropForeign('installment_pivot_transaction_transaction_id_foreign');
        });
    }
}