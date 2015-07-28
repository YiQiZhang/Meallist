<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeallistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meallist', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('name');
            $table->integer('plan_id');
            $table->decimal('energy', 8, 2);
            $table->decimal('protein', 8, 2);
            $table->decimal('fat', 8, 2);
            $table->decimal('carbohydrate', 8, 2);
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
        Schema::drop('meallist');
    }
}
