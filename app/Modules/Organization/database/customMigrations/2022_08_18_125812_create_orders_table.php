<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_admin_id')->unsigned()->nullable();
            $table->foreign('organization_admin_id')->references('id')->on('organization_admins');
            $table->bigInteger('point_of_sale_id')->unsigned()->nullable();
            $table->foreign('point_of_sale_id')->references('id')->on('point_of_sales');
            $table->bigInteger('point_of_sale_order_sheet_id')->unsigned()->nullable();
            $table->foreign('point_of_sale_order_sheet_id')->references('id')->on('point_of_sale_order_sheets');
            $table->float('total_amount');
            $table->float('table_number')->nullable();
            $table->enum('status',['pending','sentToPrepration','closed'])->default('pending');
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
        Schema::dropIfExists('orders');
    }
}
