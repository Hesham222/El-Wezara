<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->bigInteger('deleted_by')->unsigned()->nullable()->after('name');
            $table->foreign('deleted_by')->references('id')->on('organization_admins');
            $table->bigInteger('created_by')->unsigned()->nullable()->after('deleted_by');
            $table->foreign('created_by')->references('id')->on('organization_admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            //
        });
    }
}
