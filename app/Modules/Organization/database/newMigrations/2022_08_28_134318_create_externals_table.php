<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('external_pricing_id')->unsigned()->nullable();
            $table->foreign('external_pricing_id')->references('id')->on('external_pricings')->onDelete('cascade');
            $table->bigInteger('subscriber_type_id')->unsigned()->nullable();
            $table->foreign('subscriber_type_id')->references('id')->on('customer_types')->onDelete('cascade');
            $table->float('price_per_hour');
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
        Schema::dropIfExists('externals');
    }
}
