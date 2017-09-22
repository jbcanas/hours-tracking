<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGangSheetEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gang_sheet_employees', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gang_sheet_id');
            $table->integer('employee_id');
            $table->string('ilwu_number');
            $table->string('company_number');
            $table->string('job_position');
            $table->string('registration_status');
            $table->string('office_use')->nullable();
            $table->string('labor_code')->nullable();
            $table->decimal('st', 5, 2)->nullable();
            $table->decimal('st_other', 5, 2)->nullable();
            $table->decimal('st_pay', 5, 2)->nullable();
            $table->decimal('ot', 5, 2)->nullable();
            $table->decimal('ot_other', 5, 2)->nullable();
            $table->decimal('ot_pay', 5, 2)->nullable();
            $table->decimal('pot', 5, 2)->nullable();
            $table->decimal('pot_other', 5, 2)->nullable();
            $table->decimal('pot_pay', 5, 2)->nullable();
            $table->decimal('dt', 5, 2)->nullable();
            $table->decimal('dt_pay', 5, 2)->nullable();
            $table->decimal('adjust_pay', 5, 2)->nullable();
            $table->decimal('health', 5, 2)->nullable();
            $table->decimal('pension', 5, 2)->nullable();
            $table->decimal('vacation', 5, 2)->nullable();
            $table->decimal('holiday', 5, 2)->nullable();
            $table->decimal('weekly_indemnity', 5, 2)->nullable();
            $table->decimal('admin_fee', 5, 2)->nullable();
            $table->decimal('employer_taxes', 5, 2)->nullable();
            $table->decimal('workmans_comp', 5, 2)->nullable();
            $table->integer('replacement');

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
        Schema::dropIfExists('gang_sheet_employees');
    }
}
