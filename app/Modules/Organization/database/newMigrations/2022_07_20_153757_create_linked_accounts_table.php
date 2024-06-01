<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkedAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hotel_reservation_id')->unsigned();
            $table->foreign('hotel_reservation_id')->references('id')->on('hotel_reservations')->onDelete('cascade');
            $table->string('name');
            $table->string('national_id');
            $table->string('attachment');
            $table->string('marriage_contract')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('linked_accounts');
    }
}
