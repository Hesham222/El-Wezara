<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToRentContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_contracts', function (Blueprint $table) {
            $table->enum('durationType', ['Annually','Monthly','Weekly','Daily'])->after('rent_space_id');
            $table->integer('duration')->after('durationType');
            $table->enum('paymentType', ['InAdvance', 'Afterward'])->after('revenue_share');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_contracts', function (Blueprint $table) {
            //
        });
    }
}
