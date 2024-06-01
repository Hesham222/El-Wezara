<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriberIdToSubscriberAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriber_attendances', function (Blueprint $table) {

            $table->bigInteger('subscriber_id')->unsigned()->nullable()->after('id');;
            $table->foreign('subscriber_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriber_attendances', function (Blueprint $table) {
            //
        });
    }
}
