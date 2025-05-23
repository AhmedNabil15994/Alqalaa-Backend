<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintReportRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('print_reports_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('user_id')->unsigned();
            $table->tinyInteger('status')->nullable();
            $table->string('type')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
		Schema::drop('print_reports_requests');
    }
}