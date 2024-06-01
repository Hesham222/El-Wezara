<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryStokingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_stokings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_admin_id')->unsigned()->nullable();
            $table->foreign('organization_admin_id')->references('id')->on('organization_admins');
            $table->bigInteger('laundry_id')->unsigned()->nullable();
            $table->foreign('laundry_id')->references('id')->on('laundries');
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
        Schema::dropIfExists('laundry_stokings');
    }
}
