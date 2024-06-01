<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryHotelOrderServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_hotel_order_services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('laundry_hotel_order_id')->unsigned();
            $table->foreign('laundry_hotel_order_id')->references('id')->on('laundry_hotel_orders')->onDelete('cascade');
            $table->bigInteger('laundry_sub_category_id')->unsigned();
            $table->foreign('laundry_sub_category_id')->references('id')->on('laundry_sub_categories')->onDelete('cascade');
            $table->bigInteger('laundry_category_id')->unsigned();
            $table->foreign('laundry_category_id')->references('id')->on('laundry_categories')->onDelete('cascade');

            $table->bigInteger('laundry_service_id')->unsigned();
            $table->foreign('laundry_service_id')->references('id')->on('l_services')->onDelete('cascade');
            $table->integer('quantity');
            $table->double('price');
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
        Schema::dropIfExists('laundry_hotel_order_services');
    }
}
