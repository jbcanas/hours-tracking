<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGangsheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gang_sheets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('account_description');
            $table->string('job_name');
            $table->string('requested_by');
            $table->integer('arbitration_award');
            $table->datetime('request_date');
            $table->datetime('work_date');
            $table->string('vessel_barge');
            $table->string('voyage');
            $table->string('start_time');
            $table->string('job_sheet_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('gang_sheets', function (Blueprint $table) {
            //
        });
    }
}
