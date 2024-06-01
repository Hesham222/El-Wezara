<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('laundry_id')->unsigned();
            $table->foreign('laundry_id')->references('id')->on('laundries')->onDelete('cascade');
            $table->bigInteger('l_service_id')->unsigned();
            $table->foreign('l_service_id')->references('id')->on('l_services')->onDelete('cascade');
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
        Schema::dropIfExists('laundry_services');
    }
}
