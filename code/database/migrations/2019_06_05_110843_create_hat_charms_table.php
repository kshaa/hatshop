<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHatCharmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hat_charms', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('hat_id')->unsigned();
            $table->bigInteger('charm_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('hat_charms', function (Blueprint $table) {
            $table->foreign('hat_id')->references('id')->on('hats')
                ->onDelete('cascade');
            $table->foreign('charm_id')->references('id')->on('charms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hat_charms');
    }
}
