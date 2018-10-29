<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConsumptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_consumptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_budget_id')->unsigned();
            $table->foreign('user_budget_id')->references('id')->on('user_budgets');
            $table->string('name');
            $table->integer('quantity');
            $table->integer('total_fee');
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
        Schema::dropIfExists('user_consumptions');
    }
}
