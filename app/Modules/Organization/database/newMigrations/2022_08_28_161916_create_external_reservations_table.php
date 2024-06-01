<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscriber_id')->unsigned()->nullable();
            $table->foreign('subscriber_id')->references('id')->on('customers')->onDelete('cascade');
            $table->bigInteger('external_pricing_id')->unsigned()->nullable();
            $table->foreign('external_pricing_id')->references('id')->on('external_pricings')->onDelete('cascade');
            $table->float('num_of_hours');
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->float('total');
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
        Schema::dropIfExists('external_reservations');
    }
}
