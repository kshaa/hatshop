<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hats', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('code');
            $table->string('label');
            $table->string('description')->nullable();
            $table->string('model_path')->nullable();
            $table->boolean('active')->default(false);
            $table->bigInteger('creator_id')->unsigned()->nullable();
            $table->bigInteger('owner_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('hats', function (Blueprint $table) {
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hats');
    }
}
