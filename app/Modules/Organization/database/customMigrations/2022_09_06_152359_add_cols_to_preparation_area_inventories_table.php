<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToPreparationAreaInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preparation_area_inventories', function (Blueprint $table) {

            $table->integer('manufacturedQuantity')->nullable();
            $table->float('calc_cost')->nullable();
            $table->float('financial_value')->nullable();
            $table->float('final_cost')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preparation_area_inventories', function (Blueprint $table) {
            //
        });
    }
}
