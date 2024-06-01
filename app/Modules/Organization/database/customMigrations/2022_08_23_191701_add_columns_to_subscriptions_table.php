<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->float('overpriced')->nullable();
            $table->string('current_session');
            $table->integer('attendance')->nullable();
            $table->string('attendance_price')->nullable();
            $table->integer('commission')->nullable();
            $table->string('rest_of_paid')->nullable();
            $table->string('amount_after_discount')->nullable();
            $table->string('cancelled_at')->nullable();
            $table->bigInteger('cancelled_by')->unsigned()->nullable();
            $table->foreign('cancelled_by')->references('id')->on('organization_admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            //
        });
    }
}
