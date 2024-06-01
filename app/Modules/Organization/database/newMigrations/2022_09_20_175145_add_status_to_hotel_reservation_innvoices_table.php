<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToHotelReservationInnvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_reservation_innvoices', function (Blueprint $table) {
            $table->enum('status', ['Not Confirmed', 'System Confirmed','Admin Confirmed'])->default('Not Confirmed')->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_reservation_innvoices', function (Blueprint $table) {
            //
        });
    }
}
