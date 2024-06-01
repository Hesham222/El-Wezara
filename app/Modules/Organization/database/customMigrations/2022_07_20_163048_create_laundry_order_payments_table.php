<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_order_payments', function (Blueprint $table) {
            $table->id();
            $table->double('total_remaining_amount');
            $table->double('remaining_amount');
            $table->double('paid_amount');
            $table->bigInteger('laundry_order_id')->unsigned();
            $table->foreign('laundry_order_id')->references('id')->on('laundry_orders')->onDelete('cascade');
            $table->enum('method', ['Cash', 'Visa']);
            $table->date('date');
            $table->time('time');
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
        Schema::dropIfExists('laundry_order_payments');
    }
}
