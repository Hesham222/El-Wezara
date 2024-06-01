<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelReservationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_reservation_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_reservation_id')->unsigned()->nullable();
            $table->foreign('hotel_reservation_id')->references('id')->on('hotel_reservations');
            $table->tinyInteger('financial_status')->default(0);
            $table->float('amount')->default(0);
            $table->enum('method',['Cash','Visa']);
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
        Schema::dropIfExists('hotel_reservation_payments');
    }
}
