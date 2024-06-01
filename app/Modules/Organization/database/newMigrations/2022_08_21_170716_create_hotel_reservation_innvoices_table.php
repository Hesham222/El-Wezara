<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelReservationInnvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_reservation_innvoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_reservation_id')->unsigned()->nullable();
            $table->foreign('hotel_reservation_id')->references('id')->on('hotel_reservations');
            $table->morphs('model');
            $table->float('amount')->default(0);
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
        Schema::dropIfExists('hotel_reservation_innvoices');
    }
}
