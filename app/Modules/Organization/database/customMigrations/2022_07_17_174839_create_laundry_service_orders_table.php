<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryServiceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_service_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('laundry_id')->unsigned()->nullable();
            $table->foreign('laundry_id')->references('id')->on('laundries');            $table->enum('department', ['events', 'iskan', 'entry_gate','sport_activities']);
            $table->date('date');
            $table->time('time');
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
        Schema::dropIfExists('laundry_service_orders');
    }
}
