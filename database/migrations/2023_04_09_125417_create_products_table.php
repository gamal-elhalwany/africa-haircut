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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('code')->nullable();
            $table->integer('buy_price')->nullable();
            $table->integer('sell_price');
            $table->integer('distribution_value')->nullable();
            $table->integer('quantity')->default(1)->nullable();
            $table->integer('net_profit')->nullable();
            $table->enum('status',['product','service', 'packages'])->nullable();

            $table->foreignId('branch_id')->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
};
