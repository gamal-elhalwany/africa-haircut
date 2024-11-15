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
        Schema::table('chair_processes', function (Blueprint $table) {
            $table->timestamp('check_in')->nullable()->after('customer_id');
            $table->timestamp('check_out')->nullable()->after('check_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chair_processes', function (Blueprint $table) {
            $table->dropColumn(['check_in', 'check_out']);
        });
    }
};
