<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVacsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->float('current_vacations')->nullable();
            $table->tinyInteger('is_disabled')->nullable();
            $table->text('disabled_desc')->nullable();
            $table->date('vacation_renew_date')->nullable();
            $table->float('remaining_vacs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
