<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_shifts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('week_day_id')->unsigned()->nullable();
            $table->foreign('week_day_id')->references('id')->on('week_days');
            $table->bigInteger('gate_id')->unsigned()->nullable();
            $table->foreign('gate_id')->references('id')->on('gates');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('organization_admins');
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
        Schema::dropIfExists('gate_shifts');
    }
}
