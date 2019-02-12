<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_group_id')->unsigned();
            $table->foreign('user_group_id')->references('id')->on('user_groups');
            $table->integer('value');
            $table->integer('type');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('group_requests');
    }
}
