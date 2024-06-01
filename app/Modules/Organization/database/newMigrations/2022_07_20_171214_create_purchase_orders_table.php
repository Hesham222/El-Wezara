<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on(config('database.connections.mysql.database').'.statues')->onDelete('set null');
            $table->bigInteger('vendor_id')->unsigned()->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
            $table->string('reference_number')->nullable();
            $table->date('ordered_date')->default(date("Y-m-d H:i:s"));
            $table->date('expected')->default(date("Y-m-d H:i:s"));
            $table->date('arrival_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->longText('shipping_note')->nullable();
            $table->longText('general_notes')->nullable();
            $table->longText('check_in_comments')->nullable();
            $table->double('shipping_cost', 8, 2)->default(0);
            $table->double('discount_amount', 8, 2)->default(0);
            $table->double('vat', 8, 2)->default(0);
            $table->double('subtotal', 8, 2)->default(0);
            $table->double('total', 8, 2)->default(0);
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
        Schema::dropIfExists('purchase_orders');
    }
}
