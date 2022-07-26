<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadSalaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('upload_salary_details', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('employee_id');
            $table->string('month_of_salary',20);
            $table->string('designation');
            $table->string('department');
            $table->integer('basic_salary')->default('0');
            $table->integer('arrs')->default('0');
            $table->integer('total_overtime_amount')->default('0');
            $table->integer('ta')->default('0');
            $table->integer('refund')->default('0');
            $table->integer('tds')->default('0');
            $table->integer('pf')->default('0');
            $table->integer('esi')->default('0');
            $table->integer('e_bill')->default('0');
            $table->integer('trans_charge')->default('0');
            $table->integer('adv')->default('0');
            $table->integer('acco')->default('0');
            $table->integer('prof_tax')->default('0');
            $table->integer('total_absence_amount')->default('0');
            $table->integer('total_earning')->default('0');
            $table->integer('total_deduction')->default('0');
            $table->integer('net_salary')->default('0');
            $table->integer('gross_salary')->default('0');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('upload_salary_details');
    }
}
