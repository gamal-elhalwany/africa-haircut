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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->unique();
            $table->text('national_id')->unique();
            $table->bigInteger('emp_id')->unique();
            $table->dateTime('hiring_date');
            $table->bigInteger('job_id');
            $table->enum('salary_system',['basic','commotion','basic_and_commotion']);
            $table->float('salary',15,2)->nullable();
            $table->bigInteger('commotion')->nullable();
            $table->integer('work_days')->nullable();;
            $table->integer('work_hours')->nullable();;
            $table->enum('gender',['male','female']);
            $table->bigInteger('branch_id')->nullable();;

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
        Schema::dropIfExists('users');
    }
};
