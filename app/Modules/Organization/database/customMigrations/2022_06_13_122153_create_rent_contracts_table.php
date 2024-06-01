<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_contracts', function (Blueprint $table) {
            $table->id();
//            $table->bigInteger('tenant_id')->unsigned()->nullable();
//            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->bigInteger('rent_space_id')->unsigned()->nullable();
            $table->foreign('rent_space_id')->references('id')->on('rent_spaces');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('amount');
            $table->double('annual_increase');
            $table->string('attachment');
            $table->double('revenue_share')->nullable();
            $table->longText('notes')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('organization_admins');
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
        Schema::dropIfExists('rent_contracts');
    }
}
