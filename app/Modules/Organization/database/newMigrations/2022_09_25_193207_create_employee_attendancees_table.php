<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAttendanceesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_attendancees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('checkIn')->nullable();
             $table->string('checkOut')->nullable();
             $table->string('workingHours')->nullable();
             $table->string('overTimeDuration')->nullable();
             $table->tinyInteger('vacation')->default(0);
             $table->tinyInteger('dessmissExtraHours')->default(0);
             $table->tinyInteger('approveWorkingHours')->default(0);
             $table->tinyInteger('approveExtraHours')->default(0);
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
        Schema::dropIfExists('employee_attendancees');
    }
}
