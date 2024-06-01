<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreparationAreaStockingIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparation_area_stocking_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('stocking_id')->unsigned()->nullable();
            $table->foreign('stocking_id')->references('id')->on('preparation_area_stockings');
            $table->bigInteger('ingredient_id')->unsigned()->nullable();
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
            $table->integer('quantity_before')->default(0);
            $table->integer('quantity_after')->default(0);
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
        Schema::dropIfExists('preparation_area_stocking_ingredients');
    }
}
