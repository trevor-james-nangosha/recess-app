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
        Schema::create('has_boughts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customerID')->unsigned();
            $table->bigInteger('productID')->unsigned();
            $table->integer('numberOfTimes');
            $table->boolean('returnPurchase');
            $table->timestamps();

            $table->foreign('productID')->references('id')->on('products');
            $table->foreign('customerID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('has_boughts');
    }
};
