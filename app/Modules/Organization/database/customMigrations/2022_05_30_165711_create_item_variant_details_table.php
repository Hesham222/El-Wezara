<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemVariantDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_variant_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_variant_id')->unsigned()->nullable();
            $table->foreign('item_variant_id')->references('id')->on('item_variants')->onDelete('cascade');
            $table->bigInteger('item_detail_id')->unsigned()->nullable();
            $table->foreign('item_detail_id')->references('id')->on('item_details')->onDelete('cascade');
            $table->integer('quantity');
            $table->tinyInteger('removable')->default(0);
            $table->tinyInteger('variant')->default(0);
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
        Schema::dropIfExists('item_variant_details');
    }
}
