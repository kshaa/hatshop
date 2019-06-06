<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seller_id')->unsigned();
            $table->bigInteger('buyer_id')->unsigned()->nullable();
            $table->bigInteger('yarn')->unsigned();
            $table->string('product_type');
            $table->bigInteger('product_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('trades', function (Blueprint $table) {
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('buyer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
