<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {

              $table->enum('gender',['male','female'])->nullable();
              $table->text('sending_address')->nullable();
              $table->string('secondPhone')->nullable();
              $table->text('medical_condition')->nullable();
              $table->text('medications_in_emergecies')->nullable();
              $table->date('insurance_date')->nullable();
              $table->date('contract_end_date')->nullable();
              $table->date('health_certificate_end_date')->nullable();
              $table->date('national_id_end_date')->nullable();
              $table->integer('first_year_ordinary_vacation')->default(0);
              $table->integer('next_years_ordinary_vacation')->default(0);
              $table->integer('first_year_emergency_vacation')->default(0);
              $table->integer('next_years_emergency_vacation')->default(0);

              $table->integer('hours_per_days')->nullable();

              $table->float('start_hour')->nullable();
              $table->float('end_hour')->nullable();
              $table->float('extra_hour_price')->nullable();
              $table->integer('approved')->default(0);
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
