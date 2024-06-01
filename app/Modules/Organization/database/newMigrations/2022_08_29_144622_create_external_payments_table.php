<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscriber_id')->unsigned()->nullable();
            $table->foreign('subscriber_id')->references('id')->on('customers')->onDelete('cascade');
            $table->bigInteger('external_reservation_id')->unsigned()->nullable();
            $table->foreign('external_reservation_id')->references('id')->on('external_reservations')->onDelete('cascade');
            $table->float('payment_amount');
            $table->string('payment_method');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('organization_admins');
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
        Schema::dropIfExists('external_payments');
    }
}
