<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointOfSaleInventoryConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_sale_inventory_consumptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inventory_id')->unsigned()->nullable();
            $table->foreign('inventory_id')->references('id')->on('point_of_sale_inventories');
            $table->integer('old_quantity');
            $table->integer('used_quantity');
            $table->integer('new_quantity');
            $table->bigInteger('created_by')->unsigned()->nullable();
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
        Schema::dropIfExists('point_of_sale_inventory_consumptions');
    }
}
