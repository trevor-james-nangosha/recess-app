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
            $table->bigInteger('userID')->nullable();
            $table->string('kind')->nullable();
            $table->string('description');
            $table->integer('totalQuantityPosted')->nullable();
            $table->integer('totalQuantitySold')->nullable();
            $table->integer('quantityAvailable');
            $table->float('ratePerItem');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users');
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
