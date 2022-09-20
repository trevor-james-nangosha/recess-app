<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('userID')->unsigned()->nullable();
            $table->bigInteger('productID')->unsigned()->nullable();
            $table->integer('quantityOrdered');
            $table->float('totalAmount');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('productID')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
