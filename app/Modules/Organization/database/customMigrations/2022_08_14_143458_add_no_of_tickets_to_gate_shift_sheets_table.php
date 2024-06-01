<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoOfTicketsToGateShiftSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gate_shift_sheets', function (Blueprint $table) {
            $table->string('no_of_tickets')->default(0)->after('end_balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gate_shift_sheets', function (Blueprint $table) {
            //
        });
    }
}
