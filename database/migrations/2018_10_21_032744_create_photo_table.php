<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->integer('notification_id')->unsigned();
            $table->integer('group_consumption_id')->unsigned();
            $table->integer('user_consumption_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->foreign('notification_id')->references('id')->on('notifications')->nullable();
            $table->foreign('group_consumption_id')->references('id')->on('group_consumptions')->nullable();
            $table->foreign('user_consumption_id')->references('id')->on('user_consumptions')->nullable();
            $table->string('name');
            $table->integer('type');
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
        Schema::dropIfExists('photos');
    }
}
