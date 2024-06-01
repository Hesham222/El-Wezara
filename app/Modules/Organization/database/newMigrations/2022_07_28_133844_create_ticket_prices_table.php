<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ticket_category_id')->unsigned();
            $table->foreign('ticket_category_id')->references('id')->on('ticket_categories')->onDelete('cascade');
            $table->bigInteger('ticket_sub_category_id')->unsigned();
            $table->foreign('ticket_sub_category_id')->references('id')->on('ticket_sub_categories')->onDelete('cascade');
            $table->double('price');
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('organization_admins');
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
        Schema::dropIfExists('ticket_prices');
    }
}
