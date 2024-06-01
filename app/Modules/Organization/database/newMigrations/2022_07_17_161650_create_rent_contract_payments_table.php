<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentContractPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_contract_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rent_contract_id')->unsigned()->nullable();
            $table->foreign('rent_contract_id')->references('id')->on('rent_contracts')->onDelete('cascade');;
            $table->date('payment_date');
            $table->double('amount');
            $table->tinyInteger('status')->default(0);
            $table->enum('paidBy', ['Cash', 'Visa'])->nullable();
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
        Schema::dropIfExists('rent_contract_payments');
    }
}
