<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_payments', function (Blueprint $table) {
            $table->id();
//            $table->string('contact_title');
//            $table->string('contact_name');
//            $table->string('contact_email')->nullable();
//            $table->string('contact_phone');
//            $table->string('contact_address');
//            $table->string('contact_national_id');
            $table->double('remaining_amount');
            $table->double('paid_amount');
            $table->bigInteger('reservation_id')->unsigned();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->enum('method', ['Cash', 'Visa']);
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
        Schema::dropIfExists('reservation_payments');
    }
}
