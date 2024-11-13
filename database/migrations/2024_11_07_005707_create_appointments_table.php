<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->unsignedBigInteger('chair_id');
            $table->unsignedBigInteger('branch_id');
            $table->date('appointment_date');
            $table->time('start_at'); // Start time of the appointment
            $table->time('end_at'); // End time of the appointment
            $table->enum('status', ['pending', 'canceled', 'completed'])->default('pending');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('chair_id')->references('id')->on('chairs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');

            // Unique constraint to prevent double booking
            $table->unique(['chair_id', 'appointment_date', 'start_at', 'end_at'], 'unique_appointment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
