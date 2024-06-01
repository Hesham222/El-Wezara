<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_mobile');
            $table->double('total_price');
            $table->double('paid_amount');
            $table->double('remaining_amount');
            $table->date('max_due_date');
            $table->enum('payment_method', ['cash', 'visa'])->default('cash');
            $table->date('date');
            $table->time('time');
            $table->bigInteger('laundry_id')->unsigned()->nullable();
            $table->foreign('laundry_id')->references('id')->on('laundries');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('organization_admins');
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
        Schema::dropIfExists('laundry_orders');
    }
}
