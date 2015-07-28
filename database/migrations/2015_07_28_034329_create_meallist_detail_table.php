<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeallistDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meallist_detail', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('meallist_id');
            $table->integer('meal_id');
            $table->integer('food_id');
            $table->integer('amount');
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
        Schema::drop('meallist_detail');
    }
}
