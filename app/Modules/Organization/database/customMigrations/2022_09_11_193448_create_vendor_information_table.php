<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendorType_id')->unsigned();
            $table->foreign('vendorType_id')->references('id')->on('vendor_types')->onDelete('cascade');
            $table->string('title');
            $table->string('document_type');
            $table->boolean('status')->default('0')->nullable();
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
        Schema::dropIfExists('vendor_information');
    }
}
