<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoStatusHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_status_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_admin_id')->unsigned()->nullable();
            $table->foreign('organization_admin_id')->references('id')->on('organization_admins')->onDelete('cascade');
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on(config('database.connections.mysql.database').'.statues')->onDelete('set null');
            $table->bigInteger('purchase_order_id')->unsigned()->nullable();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('set null');
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
        Schema::dropIfExists('po_status_histories');
    }
}
