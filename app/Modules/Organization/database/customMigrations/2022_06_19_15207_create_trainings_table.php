<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('club_sport_id')->unsigned();
            $table->foreign('club_sport_id')->references('id')->on('club_sports')->onDelete('cascade');
            $table->bigInteger('activity_area_id')->unsigned();
            $table->foreign('activity_area_id')->references('id')->on('sport_activity_areas')->onDelete('cascade');
            $table->bigInteger('freelance_trainer_id')->unsigned();
            $table->foreign('freelance_trainer_id')->references('id')->on('freelance_trainers')->onDelete('cascade');
            $table->string('type');
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
        Schema::dropIfExists('trainings');
    }
}
