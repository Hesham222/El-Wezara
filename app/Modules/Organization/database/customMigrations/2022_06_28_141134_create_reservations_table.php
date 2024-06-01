<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('contact_title')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->unique()->nullable();
            $table->string('contact_phone')->unique()->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_national_id')->unique()->nullable();
            $table->date('booking_date');
            $table->time('from');
            $table->time('to');
            $table->double('actual_price');
            $table->double('paid_amount')->default(0);
            $table->double('remaining_amount');
            $table->double('supplier_remaining_amount');
            $table->date('payment_due_date');
            $table->bigInteger('package_id')->unsigned()->nullable();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->bigInteger('event_type_id')->unsigned();
            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('organization_admins');
            $table->enum('status', ['tentative', 'confirmed', 'cancelled'])->default('tentative');
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
        Schema::dropIfExists('reservations');
    }
}
