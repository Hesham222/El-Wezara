<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_suppliers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reservation_id')->unsigned()->nullable();
            $table->foreign('reservation_id')->references('id')->on('reservations');
//            $table->bigInteger('supplier_id')->unsigned()->nullable();
//            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->double('paid_amount');
            $table->double('remaining_amount');
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
        Schema::dropIfExists('reservation_suppliers');
    }
}
