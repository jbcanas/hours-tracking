<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');

            $table->string('ilwu_number');
            $table->string('company_number');
            $table->string('clock_number');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_initial');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('phone_number');
            $table->datetime('birth_date');
            $table->string('ss');
            $table->string('status');
            $table->datetime('date_of_hire');
            $table->datetime('registration_date');
            $table->datetime('transfer_date');
            $table->string('registration_port');
            $table->string('profile_picture');

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
        Schema::dropIfExists('employees');
    }
}
