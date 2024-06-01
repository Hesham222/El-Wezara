<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnLaundryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_laundry_orders', function (Blueprint $table) {
            $table->id();
            $table->string('laundry_name');
            $table->string('customer_name');
            $table->string('customer_mobile');
            $table->date('date');
            $table->time('time');
            $table->double('total_price');
            $table->bigInteger('laundry_order_id')->unsigned();
            $table->foreign('laundry_order_id')->references('id')->on('laundry_orders')->onDelete('cascade');
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
        Schema::dropIfExists('return_laundry_orders');
    }
}
