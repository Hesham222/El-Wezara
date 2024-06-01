<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacation_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->bigInteger('employee_vacation_type_id')->unsigned()->nullable();
            $table->foreign('employee_vacation_type_id')->references('id')->on('employee_vacation_types');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('note')->nullable();
            $table->enum('status',['Pending','Approved','Rejected'])->default('Pending');
            $table->integer('vacation_duration')->default(0);
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
        Schema::dropIfExists('vacation_requests');
    }
}
