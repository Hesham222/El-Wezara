<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryOrderSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_order_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('laundry_sub_category_id')->unsigned();
            $table->foreign('laundry_sub_category_id')->references('id')->on('laundry_sub_categories')->onDelete('cascade');
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
        Schema::dropIfExists('laundry_order_sub_categories');
    }
}
