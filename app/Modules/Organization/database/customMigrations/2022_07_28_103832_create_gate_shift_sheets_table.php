<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGateShiftSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_shift_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_admin_id')->unsigned()->nullable();
            $table->foreign('organization_admin_id')->references('id')->on('organization_admins');
            $table->bigInteger('gate_id')->unsigned()->nullable();
            $table->foreign('gate_id')->references('id')->on('gates');
            $table->date('shift_date');
            $table->dateTime('shift_start');
            $table->dateTime('shift_end')->nullable();
            $table->double('start_balance');
            $table->double('end_balance')->default(0);
            $table->double('ticketsAmount')->default(0);
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
        Schema::dropIfExists('gate_shift_sheets');
    }
}
