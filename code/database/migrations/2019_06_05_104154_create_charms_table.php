<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('label');
            $table->string('color');
            $table->string('power_label');
            $table->string('power_code');
            $table->bigInteger('power_intensity');
            $table->string('description')->nullable();
            $table->boolean('active')->default(false);
            $table->bigInteger('creator_id')->unsigned();
            $table->bigInteger('owner_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('charms', function (Blueprint $table) {
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
        Schema::dropIfExists('charms');
    }
}
