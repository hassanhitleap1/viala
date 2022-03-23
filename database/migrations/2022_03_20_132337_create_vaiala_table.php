<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaialaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaila', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desc');
            $table->smallInteger('status')->default(0);
            $table->smallInteger('new_arrivals')->default(0);
            $table->smallInteger('special')->default(0);
            $table->integer('user_id');
            $table->integer('governorate_id');
            $table->integer('has_pool');
            $table->integer('has_barbikio');
            $table->integer('has_parcking');
            $table->integer('for_shbab');
            $table->float('price');
            $table->float('price_weekend');
            $table->float('price_hoolday');
            $table->smallInteger('number_room');
            $table->smallInteger('garden');
            $table->smallInteger('conditioners');
            $table->smallInteger('kitchen');
            $table->smallInteger('wifi');
            $table->string('thumb');
            $table->integer('view')->default(0);
            $table->string('lag')->nullable();
            $table->string('lat')->nullable();
            $table->integer('number_booking')->default(0);
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
        Schema::dropIfExists('vaiala');
    }
}
