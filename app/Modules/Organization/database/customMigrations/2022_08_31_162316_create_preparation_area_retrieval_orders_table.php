<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreparationAreaRetrievalOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparation_area_retrieval_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sender_id')->unsigned()->nullable();
            $table->foreign('sender_id')->references('id')->on('preparation_areas');
            $table->bigInteger('resever_id')->unsigned()->nullable();
            $table->foreign('resever_id')->references('id')->on('preparation_areas');
            $table->enum('type',['general','internal'])->default('general');
            $table->enum('status',['pending','approved','canceled'])->default('pending');
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
        Schema::dropIfExists('preparation_area_retrieval_orders');
    }
}
