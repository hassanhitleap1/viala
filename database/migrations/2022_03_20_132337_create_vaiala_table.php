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
            $table->integer('has_pool')->default(0);
            $table->integer('has_barbikio')->default(0);
            $table->integer('has_parcking')->default(0);
            $table->integer('for_shbab')->default(0);
            $table->float('price');
            $table->float('price_weekend');
            $table->float('price_hoolday');
            $table->smallInteger('number_room');
            $table->smallInteger('garden')->default(0);
            $table->smallInteger('conditioners')->default(0);
            $table->smallInteger('kitchen')->default(0);
            $table->smallInteger('wifi')->default(0);
            $table->string('thumb');
            $table->integer('view')->default(0);
            $table->string('lag')->nullable();
            $table->string('lat')->nullable();
            $table->integer('number_booking')->default(0);
            $table->tinyInteger('rates')->default(0);
            $table->smallInteger('active')->default(0);
            $table->softDeletes();
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
