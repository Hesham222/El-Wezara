<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelInnvoiceExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_innvoice_extras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hotel_reservation_innvoice_id')->unsigned();
            $table->foreign('hotel_reservation_innvoice_id')->references('id')->on('hotel_reservation_innvoices')->onDelete('cascade');
            $table->integer('extraPerson')->nullable();
            $table->double('extraPersonPrice')->nullable();
            $table->integer('extraChild')->nullable();
            $table->double('extraChildPrice')->nullable();
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
        Schema::dropIfExists('hotel_innvoice_extras');
    }
}
