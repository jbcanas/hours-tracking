<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGangSheetsTable extends Migration
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
            $table->integer('user_id');
            $table->string('dispatch_by');
            $table->string('job_sheet_number');
            $table->string('ilwu_job_number');
            $table->string('account_description');
            $table->string('job_name');
            $table->string('job_location');
            $table->string('vessel_barge');
            $table->string('start_time');
            $table->string('stop_time');
            $table->string('moves');
            $table->string('gang');
            $table->string('voyage');
            $table->longText('notes');
            $table->datetime('dispatch_date');
            $table->datetime('work_date');
            $table->integer('coffee_break');
            $table->integer('meal_break');
            $table->integer('early_start');
            $table->integer('arbitrary_award');
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
        Schema::dropIfExists('gang_sheets');
    }
}
