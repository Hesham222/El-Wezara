<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->bigInteger('employee_type_id')->unsigned();
            $table->foreign('employee_type_id')->references('id')->on('employee_types');
            $table->bigInteger('employee_job_id')->unsigned();
            $table->foreign('employee_job_id')->references('id')->on('employee_jobs');
            $table->integer('vacation_balance')->default(0);
            $table->string('phone');
            $table->date('date_of_hiring');
            $table->date('birth_date');
            $table->string('insurance_number')->nullable();
            $table->enum('social_status',['Single','Engaged','Married','Divorced','Widowed']);
            $table->text('address');
            $table->enum('military_status',['Postponed','Exempted','Done']);
            $table->float('gross_salary')->nullable();
            //$table->enum('taxes_type',['Percentage','Number']);
            //$table->integer('taxes_value');
            //$table->enum('insurance_type',['Percentage','Number']);
            //$table->integer('insurance_value');
            $table->float('net_salary')->nullable();
            $table->text('fingerprint')->nullable();
            $table->string('attachment')->nullable();
            $table->tinyInteger('isSystemUser')->default(0);
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('organization_admins');
            $table->softDeletes();
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
