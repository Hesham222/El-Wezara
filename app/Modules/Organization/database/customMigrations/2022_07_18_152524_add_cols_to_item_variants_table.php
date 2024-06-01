<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToItemVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_variants', function (Blueprint $table) {
            $table->float('final_cost')->nullable();
            $table->float('auxiliary_materials')->nullable();
            $table->float('mortal')->nullable();
            $table->float('variable_ratio')->nullable();
            $table->integer('price_options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_variants', function (Blueprint $table) {
            //
        });
    }
}
