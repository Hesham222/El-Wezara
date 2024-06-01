<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomDayPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_day_pricings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parentRoom_id')->unsigned();
            $table->foreign('parentRoom_id')->references('id')->on('parent_rooms')->onDelete('cascade');
            $table->bigInteger('customerType_id')->unsigned();
            $table->foreign('customerType_id')->references('id')->on('customer_types')->onDelete('cascade');
            $table->bigInteger('roomType_id')->unsigned();
            $table->foreign('roomType_id')->references('id')->on('room_types')->onDelete('cascade');
            $table->float('price');
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
        Schema::dropIfExists('room_day_pricings');
    }
}
