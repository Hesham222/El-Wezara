<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointOfSaleOrderSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_sale_order_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_admin_id')->unsigned()->nullable();
            $table->foreign('organization_admin_id')->references('id')->on('organization_admins');
            $table->bigInteger('point_of_sale_id')->unsigned()->nullable();
            $table->foreign('point_of_sale_id')->references('id')->on('point_of_sales');
            $table->date('shift_date');
            $table->dateTime('shift_start');
            $table->dateTime('shift_end')->nullable();
            $table->double('start_balance');
            $table->double('end_balance')->default(0);
            $table->string('no_of_orders')->default(0);
            $table->double('ordersAmount')->default(0);
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
        Schema::dropIfExists('point_of_sale_order_sheets');
    }
}
