<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointOfSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_sale_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('PointOfSale_id')->unsigned()->nullable();
            $table->foreign('PointOfSale_id')->references('id')->on('point_of_sales')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved','received','cancelled','rejected'])->default('pending');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('organization_admins')->onDelete('cascade');
            $table->text('rejection_reason')->nullable();
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
        Schema::dropIfExists('point_of_sale_orders');
    }
}
