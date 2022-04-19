<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllCimnImage extends Migration
{
    public function up()
    {
        Schema::table('services', function($table) {
            $table->string('image')->nullable();
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('settings', function($table) {
            $table->dropColumn('email');
          
        });

    }
}
